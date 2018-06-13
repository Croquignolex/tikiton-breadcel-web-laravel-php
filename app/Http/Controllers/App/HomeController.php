<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use App\Traits\ErrorFlashMessagesTrait;

class HomeController extends Controller
{
    use ErrorFlashMessagesTrait;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        try
        {
            $new_products = Product::where('created_at', '>=', now()->addDay(-7))
                ->orWhere('is_new', true)
                ->get();

            $featured_products = Product::all()->filter(function ($value){
                return ($value->ranking === 10 || $value->is_featured) ? $value : null;
            });

            $most_sold_products = Product::where('is_most_sold', true)->get();

            $testimonials = Testimonial::all();

            $customers_nbr = User::where('is_admin', false)->where('is_super_admin', false)->count();
            $products_nbr = Product::all()->count();
            $orders_nbr = Order::all()->count();
            $sales_nbr = Order::where('status', Order::SOLD)->count();
        }
        catch (Exception $exception)
        {
            $this->databaseError($exception);
        }


        return view('home.index', compact(
                'featured_products', 'customers_nbr',
                'new_products', 'most_sold_products', 'products_nbr',
                'orders_nbr', 'sales_nbr', 'testimonials'
            )
        );
    }
}
