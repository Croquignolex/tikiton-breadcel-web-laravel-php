<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * CheckoutController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('checkout.index');
    }
}
