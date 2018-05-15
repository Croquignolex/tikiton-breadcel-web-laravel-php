<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $new_products = Product::where('created_at', '>=', now()->addDay(-7))
            ->orWhere('is_new', true)
            ->get();

        $featured_products = Product::where('ranking', 10)
            ->orWhere('is_featured', true)
            ->get();

        $most_sold_products = Product::where('is_most_sold', true)
            ->get();

        return view
        (
            'home.index',
            compact(
                'featured_products',
                'new_products', 'most_sold_products'
            )
        );
    }
}
