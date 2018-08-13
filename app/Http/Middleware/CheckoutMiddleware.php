<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Setting;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            $setting = Setting::where('is_activated', true)->first();
            if ($setting !== null)
            {
                if (!$setting->order_activated)
                {
                    danger_flash_message(trans('auth.error'), trans('general.no_order', ['phone' => $setting->phone_1]));
                    return redirect(locale_route('cart.index'));
                }
            }

            $carted_products = Auth::user()->carted_products;
            if($carted_products->isEmpty())
            {
                danger_flash_message(trans('auth.error'), trans('general.empty_cart'));
                return redirect(locale_route('cart.index'));
            }

            $out_of_stock_products = $carted_products->filter(function (Product $product) {
                if($product->availability === Product::OUT_OF_STOCK)
                    return true;

                return false;
            });

            if(!$out_of_stock_products->isEmpty())
            {
                danger_flash_message(trans('auth.error'), trans('general.out_of_stock_products'));
                return redirect(locale_route('cart.index'));
            }
        }
        catch (Exception $exception) {}

        return $next($request);
    }
}
