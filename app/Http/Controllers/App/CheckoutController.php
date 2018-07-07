<?php

namespace App\Http\Controllers\App;

use App\Mail\NewOrderMail;
use App\Models\Email;
use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Mail\UserOrderUserMail;
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
        $this->middleware('out.of.stock');
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
            flash_message(
                trans('auth.success'), trans('general.info_updated')
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }
        return $this->redirectTo();
    }

    public function order()
    {
        try
        {
            if($this->userHasAllInformation())
            {
                $user = Auth::user();
                $this->couponSession($user);

                $order = $user->orders()->create([
                    'reference' => Order::getUniqueOrderReference(),
                    'discount' => session()->has('coupon') ? session('coupon')->discount : 0
                ]);

                foreach ($user->carted_products as $product)
                {
                    $product_quantity_in_cart = $product->pivot->quantity;
                    $order->products()->save($product, ['quantity' => $product_quantity_in_cart]);

                    $product->stock = $product->stock - $product_quantity_in_cart;
                    $product->save();
                }

                $to = new Email();
                $to->email = config('company.email_1');
                $to->name = config('company.name');
                try
                {
                    Mail::to($user)->send(new UserOrderUserMail($order));
                    Mail::to($to)->send(new NewOrderMail($order));
                }
                catch (Exception $exception)
                {
                    $this->mailError($exception);
                }

                session()->forget(['coupon']);
                foreach ($user->user_carts as $user_cart)
                    $user_cart->delete();

                $this->disableCoupon($user);

                flash_message(
                    trans('auth.success'), trans('general.success_order')
                );

                return redirect(locale_route('orders.index'));
            }
            else
            {
                flash_message(
                    trans('auth.error'), trans('general.fill_information'), font('remove'),
                    'danger', 'bounceIn', 'bounceOut'
                );
            }

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
