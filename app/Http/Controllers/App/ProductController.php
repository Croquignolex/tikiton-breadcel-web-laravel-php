<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('products.index');
    }
}