<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\CartUpdateRequest;

class CartController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only('ajaxProducts');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $carted_products = Auth::user()->carted_products;
        return view('cart', compact('carted_products'));
    }

    /**
     * @param CartUpdateRequest $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CartUpdateRequest $request, $language, Product $product)
    {
        if($product->stock >= $request->quantity)
        {
            Auth::user()
                ->carted_products()
                ->updateExistingPivot($product->id, ['quantity' => $request->quantity]);
        }
        else
        {
            Auth::user()
                ->carted_products()
                ->updateExistingPivot($product->id, ['quantity' => $product->stock]);

            flash_message(
                trans('auth.error'),
                trans('general.max_to_order', ['max' => $product->stock, 'product' => $product->format_name]),
                font('remove'), 'danger', 'bounceIn', 'bounceOut');
        }

        return $this->redirectTo();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxProducts()
    {
        $products =  Auth::user()->carted_products;
        return response()->json(compact('products'));
    }

    /**
     * @param CouponRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyCoupon(CouponRequest $request)
    {
        $coupon_code = $request->coupon;
        try
        {
            $user = Auth::user();
            $coupon = $user->coupons->where('code', $coupon_code)->first();
            if($coupon !== null)
            {
                if($coupon->pivot->is_activated)
                {
                    if($user->getTotalInCart() > $coupon->discount)
                    {
                        session(['coupon' => $coupon]);
                        flash_message(
                            trans('auth.info'), trans('general.coupon_applied', ['code' => $coupon_code]),
                            font('info-circle'), 'info'
                        );
                    }
                    else
                    {
                        session()->forget(['coupon.discount', 'coupon.code']);
                        flash_message(
                            trans('auth.info'), trans('general.coupon_could_not_be_applied'),
                            font('info-circle'), 'info'
                        );
                    }
                }
                else flash_message(
                    trans('auth.error'), trans('general.coupon_already_used', ['coupon' => $coupon_code]),
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );
            }
            else flash_message(
                trans('auth.error'), trans('general.incorrect_coupon'),
                font('remove'), 'danger', 'bounceIn', 'bounceOut'
            );
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
        return redirect(locale_route('cart.index'));
    }
}
