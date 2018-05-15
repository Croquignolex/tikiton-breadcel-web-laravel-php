<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * @param Product $product
     * @return bool
     * @internal param Account $account
     */
    public function isNew(Product $product)
    {
        return $product->is_new || ($product->created_at >= now()->addDay(-7)) ? true : false;
    }

    /**
     * @param Product $product
     * @return bool
     * @internal param Account $account
     */
    public function isFeatured(Product $product)
    {
        return $product->is_featured || $product->ranking === 10 ? true : false;
    }
}