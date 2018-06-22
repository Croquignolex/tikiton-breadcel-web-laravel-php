<?php

namespace App\Http\Controllers\App\Auth;

use App\Models\Product;
use App\Models\UserWishList;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->only('validation');
        $this->middleware('auth')->except('validation');
        $this->middleware('ajax')->only('ajax_wishlist_manage');
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
    public function remove_product_from_wishlist(Request $request, $language, Product $product)
    {
        try
        {
            $user_wish_list = Auth::user()
                ->user_wish_lists()
                ->where('product_id', $product->id)->first();

            $user_wish_list->delete();

            flash_message(
                trans('auth.info'), trans('general.product_removed_wishlist'),
                font('info-circle'), 'info'
            );
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }

        return redirect(locale_route('account.wishlist'));
    }

    public function ajax_wishlist_manage(Request $request)
    {
        $product_id = $request->input('product_id');
        try
        {
            $product = Product::find(intval($product_id));
            $products_in_user_cart = Auth::user()->wished_products;
            if($products_in_user_cart->contains($product))
            {
                $wish_list = UserWishList::where('user_id', Auth::user()->id)
                    ->where('product_id', $product->id)->first();
                if($wish_list !== null) $wish_list->delete();
                $response_body = trans('general.removed_from_wish_list',
                    ['product' => $product->format_name]);
                $response_title = trans('auth.info');
                $response_type = 'info';
            }
            else
            {
                Auth::user()->wished_products()->save($product);
                $response_body = trans('general.added_to_wish_list',
                    ['product' => $product->format_name]);
                $response_title = trans('auth.success');
                $response_type = 'success';
            }
        }
        catch (Exception $exception)
        {
            if(config('app.debug'))
            {
                $response_body = trans('general.database_error') .
                    '. ' . $exception->getMessage();
            }
            else $response_body = trans('general.database_error');
            $response_title = trans('auth.error');
            $response_type = 'danger';
        }

        return response()->json([
            'title' => $response_title,
            'body' => $response_body,
            'type' => $response_type
        ]);
    }
}
