<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cart.index');
    }
}
