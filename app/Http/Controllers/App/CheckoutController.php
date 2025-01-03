<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Setting;
use App\Mail\NewOrderMail;
use App\Mail\UserOrderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\CheckoutUpdateRequest;

class CheckoutController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $carted_products = $user->carted_products;
        return view('checkout', compact('carted_products', 'user'));
    }

    /**
     * @param CheckoutUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CheckoutUpdateRequest $request)
    {
        try
        {
            Auth::User()->update($request->all());
            success_flash_message(trans('auth.success'), trans('general.info_updated'));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
        return $this->redirectTo();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function order()
    {
        try
        {
            if($this->userHasAllInformation()) {
                $user = Auth::user();
                $this->couponSession($user);

                $order = $user->orders()->create([
                    'discount' => session()->has('coupon') ? session('coupon')->discount : 0,
                    'shipping_address' => $user->shipping_address,
                    'shipping_city' => $user->shipping_city,
                    'shipping_country' => $user->shipping_country,
                    'shipping_post_code' => $user->shipping_post_code,
                ]);

                foreach ($user->carted_products as $product) {
                    $product_quantity_in_cart = $product->pivot->quantity;
                    $order->products()->save($product, ['quantity' => $product_quantity_in_cart]);
                }

                $setting = Setting::where('is_activated', true)->first();
                if ($setting !== null)
                {
                    if ($setting->receive_email_from_new_order)
                    {
                        try
                        {
                            Mail::to(config('company.email_1'))->send(new NewOrderMail($order));
                        }
                        catch (Exception $exception)
                        {
                            $this->mailError($exception);
                        }
                    }
                }

                try
                {
                    Mail::to($user->email)->send(new UserOrderMail($order));
                }
                catch (Exception $exception)
                {
                    $this->mailError($exception);
                }

                foreach ($user->user_carts as $user_cart)
                    $user_cart->delete();

                $this->disableCoupon($user);

                success_flash_message(trans('auth.success'), trans('general.success_order'));

                return redirect(locale_route('orders.index'));
            }
            else
                danger_flash_message(trans('auth.error'), trans('general.fill_information'));
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
        return $this->redirectTo();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectTo()
    {
        return redirect(locale_route('checkout.index'));
    }

    /**
     * @return bool
     */
    private function userHasAllInformation()
    {
        $user = Auth::user();
        if($user->shipping_post_code === null ||
            $user->country === null || $user->phone === null ||
            $user->post_code === null || $user->city === null ||
            $user->first_name === null || $user->last_name === null ||
            $user->shipping_address === null || $user->address === null ||
            $user->shipping_city === null || $user->shipping_country === null)
            return false;
        return true;
    }

    /**
     * @param User $user
     */
    private function couponSession(User $user)
    {
        if(session()->has('coupon'))
        {
            if($user->getTotalInCart() <= session('coupon')->discount)
                session()->forget(['coupon']);
        }
    }

    /**
     * @param User $user
     */
    private function disableCoupon(User $user)
    {
        if(session()->has('coupon'))
        {
            $user->coupons()
                ->updateExistingPivot(Coupon::where('code', session('coupon')->code)->first(),
                    ['is_activated' => false]);
            session()->forget(['coupon']);
        }
    }
}
