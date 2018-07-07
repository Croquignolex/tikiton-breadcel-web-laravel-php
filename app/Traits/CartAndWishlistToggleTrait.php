<?php

namespace App\Traits;

use Exception;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\App\Auth\AccountController;

trait CartAndWishlistToggleTrait
{
    /**
     * @param $product_id
     * @param $request_type
     * @return array
     */
    private function cartAndWishlistManage($product_id, $request_type)
    {
        $icon = 'info-circle'; $isIn = true;
        $locale_body = ''; $locale_popup = '';
        $response_old_class = ''; $response_link_new_class = '';
        $response_popup = '';  $response_new_class = ''; $response_link_old_class = '';

        try
        {
            $product = Product::find(intval($product_id));

            if($request_type === AccountController::ADD_PRODUCT_TO_CART
                || $request_type === AccountController::REMOVE_PRODUCT_FROM_CART)
                $isIn = Auth::user()->carted_products->contains($product);
            elseif($request_type === AccountController::REMOVE_PRODUCT_FROM_WISH_LIST
                || $request_type === AccountController::ADD_PRODUCT_TO_WISH_LIST)
                $isIn = Auth::user()->wished_products->contains($product);

            if($isIn)
            {
                if($request_type === AccountController::REMOVE_PRODUCT_FROM_CART)
                {
                    Auth::user()->user_carts()
                        ->where('product_id', $product->id)
                        ->first()->delete();
                    $locale_body = 'removed_from_cart';
                    $icon = 'cart-arrow-down';
                }
                elseif($request_type === AccountController::REMOVE_PRODUCT_FROM_WISH_LIST)
                {
                    Auth::user()->user_wish_lists()
                        ->where('product_id', $product->id)
                        ->first()->delete();
                    $locale_body = 'removed_from_wish_list';
                    $icon = 'heart-o';
                }
                elseif($request_type === AccountController::ADD_PRODUCT_TO_CART)
                    $locale_body = 'added_already_to_cart';
                elseif ($request_type === AccountController::ADD_PRODUCT_TO_WISH_LIST)
                    $locale_body = 'added_already_to_wish_list';
            }
            else
            {
                if($request_type === AccountController::ADD_PRODUCT_TO_CART)
                {
                    Auth::user()->carted_products()->save($product);
                    $locale_body = 'added_to_cart';
                    $icon = 'cart-plus';
                }
                elseif($request_type === AccountController::ADD_PRODUCT_TO_WISH_LIST)
                {
                    Auth::user()->wished_products()->save($product);
                    $locale_body = 'added_to_wish_list';
                    $icon = 'heart';
                }
                elseif($request_type === AccountController::REMOVE_PRODUCT_FROM_CART)
                    $locale_body = 'removed_already_from_cart';
                elseif($request_type === AccountController::REMOVE_PRODUCT_FROM_WISH_LIST)
                    $locale_body = 'removed_already_from_wish_list';
            }

            if(($isIn && ($request_type === AccountController::REMOVE_PRODUCT_FROM_CART))
                || (!$isIn && ($request_type === AccountController::REMOVE_PRODUCT_FROM_CART)))
            {
                $locale_popup = 'add_to_cart';
                $response_new_class = 'cart-plus';
                $response_old_class = 'cart-arrow-down';
                $response_link_new_class = 'add-cart';
                $response_link_old_class = 'remove';
            }
            elseif (($isIn && ($request_type === AccountController::ADD_PRODUCT_TO_CART))
                || (!$isIn && ($request_type === AccountController::ADD_PRODUCT_TO_CART)))
            {
                $locale_popup = 'remove_from_cart';
                $response_new_class = 'cart-arrow-down';
                $response_old_class = 'cart-plus';
                $response_link_new_class = 'remove';
                $response_link_old_class = 'add-cart';
            }
            elseif (($isIn && ($request_type === AccountController::REMOVE_PRODUCT_FROM_WISH_LIST))
                || (!$isIn && ($request_type === AccountController::REMOVE_PRODUCT_FROM_WISH_LIST)))
            {
                $locale_popup = 'add_to_wish_list';
                $response_new_class = 'heart-o';
                $response_old_class = 'heart';
                $response_link_new_class = 'favorite';
                $response_link_old_class = 'remove';
            }
            elseif (($isIn && ($request_type === AccountController::ADD_PRODUCT_TO_WISH_LIST))
                || (!$isIn && ($request_type === AccountController::ADD_PRODUCT_TO_WISH_LIST)))
            {
                $locale_popup = 'remove_from_wish_list';
                $response_new_class = 'heart';
                $response_old_class = 'heart-o';
                $response_link_new_class = 'remove';
                $response_link_old_class = 'favorite';
            }

            if(!$isIn && ($request_type === AccountController::ADD_PRODUCT_TO_CART
                    || $request_type === AccountController::ADD_PRODUCT_TO_WISH_LIST))
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
            $response_popup = trans('general.' . $locale_popup);
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
            'link_old_class' => $response_link_old_class,
            'popup' => $response_popup, 'new_class' => 'fa-' . $response_new_class,
            'title' => $response_title, 'body' => $response_body, 'type' => $response_type,
            'icon' => $response_icon, 'enter' => $response_enter, 'exit' => $response_exit,
            'old_class' => 'fa-' . $response_old_class, 'link_new_class' => $response_link_new_class,
        ];
    }

    /**
     * @param array $response
     * @param int $response_type
     * @return \Illuminate\Http\JsonResponse
     */
    private function jsonResponse(array $response, $response_type = AccountController::NORMAL_JSON_RESPONSE)
    {
        return $response_type === AccountController::NORMAL_JSON_RESPONSE
            ? response()->json([
                'linkOldClass' => $response['link_old_class'],
                'type' => $response['type'], 'icon' => $response['icon'],
                'title' => $response['title'], 'body' => $response['body'],
                'enter' => $response['enter'], 'exit' => $response['exit'],
                'oldClass' => $response['old_class'], 'newClass' => $response['new_class'],
                'linkNewClass' => $response['link_new_class'], 'popup' => $response['popup'],
            ])
            : response()->json([
                'type' => $response['type'], 'icon' => $response['icon'],
                'title' => $response['title'], 'body' => $response['body'],
                'enter' => $response['enter'], 'exit' => $response['exit']
            ]);
    }

    /**
     * @param array $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function flashSessionResponse(array $response)
    {
        flash_message($response['title'], $response['body'], $response['icon'],
            $response['type'], $response['enter'], $response['exit']);

        return back();
    }
}