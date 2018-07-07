<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Traits\ErrorFlashMessagesTrait;
use App\Http\Requests\CartUpdateRequest;
use App\Traits\CartAndWishlistToggleTrait;
use App\Http\Controllers\App\Auth\AccountController;

class CartController extends Controller
{
    use ErrorFlashMessagesTrait, CartAndWishlistToggleTrait;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only('ajaxProducts', 'ajaxCartAdd',
            'ajaxCartRemove', 'ajaxCartRemoveAll');
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
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeProduct(Request $request, $language, Product $product)
    {
        return $this->flashSessionResponse($this->cartAndWishlistManage(
            $product->id, AccountController::REMOVE_PRODUCT_FROM_CART));
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addProduct(Request $request, $language, Product $product)
    {
        return $this->flashSessionResponse($this->cartAndWishlistManage(
            $product->id, AccountController::ADD_PRODUCT_TO_CART));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeProducts()
    {
        return $this->flashSessionResponse($this->removeProductsManager());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxAddProduct(Request $request)
    {
        return $this->jsonResponse($this->cartAndWishlistManage(
            $request->input('product_id'), AccountController::ADD_PRODUCT_TO_CART));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxRemoveProduct(Request $request)
    {
        return $this->jsonResponse($this->cartAndWishlistManage(
            $request->input('product_id'), AccountController::REMOVE_PRODUCT_FROM_CART));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxRemoveProducts()
    {
        return $this->jsonResponse($this->removeProductsManager(),
            AccountController::LIGHT_JSON_RESPONSE);
    }

    /**
     * @return array
     */
    private function removeProductsManager()
    {
        try
        {
            if(!Auth::user()->user_carts->isEmpty())
            {
                Auth::user()->user_carts()->delete();
                $locale_body = 'cart_clear';
            }
            else $locale_body = 'cart_already_clear';

            $response_type = 'info';
            $response_enter = 'flipInY';
            $response_exit = 'flipOutX';
            $response_title = trans('auth.info');
            $response_icon = font('info-circle');
            $response_body = trans('general.' . $locale_body);
        }
        catch (Exception $exception)
        {
            if(config('app.debug'))
            {
                $response_body = trans('general.database_error') .
                    '. ' . $exception->getMessage();
            }
            else $response_body = trans('general.database_error');

            $response_type = 'danger';
            $response_enter = 'bounceIn';
            $response_exit = 'bounceOut';
            $response_title = trans('auth.error');
            $response_icon = font('exclamation-triangle');
        }

        return [
            'title' => $response_title, 'body' => $response_body, 'type' => $response_type,
            'icon' => $response_icon, 'enter' => $response_enter, 'exit' => $response_exit,
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    private function redirectTo()
    {
        return redirect(locale_route('cart.index'));
    }
}
