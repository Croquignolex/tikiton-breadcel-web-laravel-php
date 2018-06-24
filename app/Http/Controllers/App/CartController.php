<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only('ajaxProducts');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxProducts()
    {
        $products =  Auth::user()->carted_products;
        return response()->json(compact('products'));
    }
}
