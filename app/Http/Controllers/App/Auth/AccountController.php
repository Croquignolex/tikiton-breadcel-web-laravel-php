<?php

namespace App\Http\Controllers\App\Auth;

use Exception;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class AccountController extends Controller
{
    use ErrorFlashMessagesTrait;

    const ADD_PRODUCT_TO_CART = 0;
    const REMOVE_PRODUCT_FROM_CART = 1;
    const TOGGLE_PRODUCT_FROM_CART = 2;
    const REMOVE_PRODUCT_FROM_WISH_LIST = 3;
    const TOGGLE_PRODUCT_FROM_WISH_LIST = 4;

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->only('validation');
        $this->middleware('auth')->except('validation');
        $this->middleware('ajax')->only('ajaxWishListToggle',
            'ajaxCartToggle', 'ajaxCartRemove');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('account.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function wishlist()
    {
        $wished_products = Auth::user()->wished_products;
        return view('account.wishlist', compact('wished_products'));
    }

    /**
     * @param Request $request
     * @param $language
     * @param $email
     * @param $token
     * @return string
     */
    public function validation(Request $request, $language, $email, $token)
    {
        try
        {
            $user = User::where([
                'token' => $token, 'email' => $email, 'is_confirmed' => false,
                'is_admin' => false, 'is_super_admin' => false
            ])->first();

            if($user === null)
            {
                flash_message(
                    trans('auth.error'), trans('general.bad_link'),
                    font('remove'), 'danger', 'bounceIn', 'bounceOut'
                );
            }
            else
            {
                $user->is_confirmed = true;
                $user->token = str_random(64);
                $user->save();

                flash_message(
                    trans('auth.success'),
                    trans('general.well_confirmed', ['name' => $user->name])
                );
            }
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return redirect(locale_route('login'));
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeProductFromWishlist(Request $request, $language, Product $product)
    {
        $response = $this->cartAndWishlistManage(
            $product->id, static::REMOVE_PRODUCT_FROM_WISH_LIST);

        flash_message($response['title'], $response['body'], $response['icon'],
            $response['type'], $response['enter'], $response['exit']);

        return redirect($this->redirectTo());
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeProductFromCart(Request $request, $language, Product $product)
    {
        $response = $this->cartAndWishlistManage(
            $product->id, static::REMOVE_PRODUCT_FROM_CART);

        flash_message($response['title'], $response['body'], $response['icon'],
            $response['type'], $response['enter'], $response['exit']);

        return redirect($this->redirectTo());
    }

    /**
     * @param Request $request
     * @param $language
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addProductToCart(Request $request, $language, Product $product)
    {
        $response = $this->cartAndWishlistManage(
            $product->id, static::ADD_PRODUCT_TO_CART);

        flash_message($response['title'], $response['body'], $response['icon'],
            $response['type'], $response['enter'], $response['exit']);

        return redirect($this->redirectTo());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxWishlistToggle(Request $request)
    {
        $response = $this->cartAndWishlistManage(
            $request->input('product_id'), static::TOGGLE_PRODUCT_FROM_WISH_LIST);

        return response()->json([
            'title' => $response['title'], 'body' => $response['body'],
            'type' => $response['type'], 'icon' => $response['icon'],
            'enter' => $response['enter'], 'exit' => $response['exit']
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCartToggle(Request $request)
    {
        $response = $this->cartAndWishlistManage(
            $request->input('product_id'), static::TOGGLE_PRODUCT_FROM_CART);

        return response()->json([
            'title' => $response['title'], 'body' => $response['body'],
            'type' => $response['type'], 'icon' => $response['icon'],
            'enter' => $response['enter'], 'exit' => $response['exit']
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxCartRemove(Request $request)
    {
        $response = $this->cartAndWishlistManage(
            $request->input('product_id'), static::REMOVE_PRODUCT_FROM_CART);

        return response()->json([
            'title' => $response['title'], 'body' => $response['body'],
            'type' => $response['type'], 'icon' => $response['icon'],
            'enter' => $response['enter'], 'exit' => $response['exit']
        ]);
    }

    /**
     * @param $product_id
     * @param $request_type
     * @return array
     */
    private function cartAndWishlistManage($product_id, $request_type)
    {
        try
        {
            $icon = 'info-circle';
            $locale_body = ''; $isIn = true;
            $product = Product::find(intval($product_id));

            if($request_type === static::ADD_PRODUCT_TO_CART
                || $request_type === static::REMOVE_PRODUCT_FROM_CART
                || $request_type === static::TOGGLE_PRODUCT_FROM_CART)
                $isIn = Auth::user()->carted_products->contains($product);
            elseif($request_type === static::REMOVE_PRODUCT_FROM_WISH_LIST
                || $request_type === static::TOGGLE_PRODUCT_FROM_WISH_LIST)
                $isIn = Auth::user()->wished_products->contains($product);

            if($isIn)
            {
                if($request_type === static::REMOVE_PRODUCT_FROM_CART
                    || $request_type === static::TOGGLE_PRODUCT_FROM_CART)
                {
                    Auth::user()->user_carts()
                        ->where('product_id', $product->id)
                        ->first()->delete();
                    $locale_body = 'removed_from_cart';
                    $icon = 'cart-arrow-down';
                }
                elseif($request_type === static::TOGGLE_PRODUCT_FROM_WISH_LIST
                    || $request_type === static::REMOVE_PRODUCT_FROM_WISH_LIST)
                {
                    Auth::user()->user_wish_lists()
                        ->where('product_id', $product->id)
                        ->first()->delete();
                    $locale_body = 'removed_from_wish_list';
                    $icon = 'heart-o';
                }
                elseif($request_type === static::ADD_PRODUCT_TO_CART)
                    $locale_body = 'added_already_from_cart';
            }
            else
            {
                if($request_type === static::ADD_PRODUCT_TO_CART
                    || $request_type === static::TOGGLE_PRODUCT_FROM_CART)
                {
                    Auth::user()->carted_products()->save($product);
                    $locale_body = 'added_to_cart';
                    $icon = 'cart-plus';
                }
                elseif($request_type === static::TOGGLE_PRODUCT_FROM_WISH_LIST)
                {
                    Auth::user()->wished_products()->save($product);
                    $locale_body = 'added_to_wish_list';
                    $icon = 'heart';
                }
                elseif($request_type === static::REMOVE_PRODUCT_FROM_CART)
                    $locale_body = 'removed_already_from_cart';
                elseif($request_type === static::REMOVE_PRODUCT_FROM_WISH_LIST)
                    $locale_body = 'removed_already_from_wish_list';
            }

            if(!$isIn && ($request_type === static::ADD_PRODUCT_TO_CART
                || $request_type === static::TOGGLE_PRODUCT_FROM_CART
                ||$request_type === static::TOGGLE_PRODUCT_FROM_WISH_LIST))
            {
                $response_type = 'success';
                $response_enter = 'lightSpeedIn';
                $response_exit = 'lightSpeedOut';
                $response_title = trans('auth.success');
            }
            else
            {
                $response_type = 'info';
                $response_enter = 'flipInY';
                $response_exit = 'flipOutX';
                $response_title = trans('auth.info');
            }

            $response_icon = font($icon);
            $response_body = trans('general.' . $locale_body,
                ['product' => $product->format_name]);
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
            'icon' => $response_icon, 'enter' => $response_enter, 'exit' => $response_exit
        ];
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return locale_route('account.wishlist');
    }
}
