<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class CartService
{
    private $cart_products;

    /**
     * CartService constructor.
     */
    public function __construct()
    {
        $this->cart_products = Auth::user()->carted_products;
    }

    /**
     * @return mixed
     */
    public function getProductNumber()
    {
        return $this->cart_products->count();
    }

    /**
     * @return mixed
     */
    public function getCartProducts()
    {
        return $this->cart_products;
    }
}