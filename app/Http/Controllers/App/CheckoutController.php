<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('checkout.index');
    }
}
