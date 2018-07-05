<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OutOfStockMiddleware
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
        $carted_products = Auth::user()->carted_products;
        if($carted_products->isEmpty())
        {
            flash_message(
                trans('auth.error'), trans('general.empty_cart'),
                font('remove'), 'danger', 'bounceIn', 'bounceOut');

            return redirect(locale_route('cart.index'));
        }

        $out_of_stock_products = $carted_products->filter(function (Product $product) {
            if($product->availability === Product::OUT_OF_STOCK)
                return true;

            return false;
        });

        if(!$out_of_stock_products->isEmpty())
        {
            flash_message(
                trans('auth.error'), trans('general.out_of_stock_products'),
                font('remove'), 'danger', 'bounceIn', 'bounceOut');

            return redirect(locale_route('cart.index'));
        }

        return $next($request);
    }
}
