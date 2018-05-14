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
        $featured_products = Product::where('ranking', 10)
            ->orWhere('is_featured', true)
            ->get();

        return view('home.index', compact('featured_products'));
    }
}
