<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\LocaleAmountTrait;

class OrderService
{
    use LocaleAmountTrait;

    /**
     * @param Order $order
     * @return mixed
     */
    public function getProductsNumber(Order $order)
    {
        return $order->products->sum(function (Product $product) {
            return $product->pivot->quantity;
        });
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getDiscount(Order $order)
    {
        return $this->formatAmount($order->discount);
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getFrDiscount(Order $order)
    {
        return $this->frFormatAmount($order->discount);
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getEnDiscount(Order $order)
    {
        return $this->enFormatAmount($order->discount);
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getSubTotal(Order $order)
    {
        return $this->formatAmount($this->getTotalInOrder($order) - $this->tva($order));
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getFrSubTotal(Order $order)
    {
        return $this->frFormatAmount($this->getTotalInOrder($order) - $this->tva($order));
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getEnSubTotal(Order $order)
    {
        return $this->enFormatAmount($this->getTotalInOrder($order) - $this->tva($order));
    }

    /**
     * @param Order $order
     * @return mixed
     */
    public function getTotalInOrder(Order $order)
    {
        return $order->products->sum(function (Product $product) {
            if($product->is_a_discount) return $product->calculateProductDiscountValue();
            else return $product->calculateProductValue();
        });
    }

    /**
     * @return int
     */
    public function getTVAPercentage()
    {
        $setting = Setting::where('is_activated', true)->first();
        if($setting !== null) return $setting->tva;

        return 0;
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getTVA(Order $order)
    {
        return $this->formatAmount($this->tva($order));
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getFrTVA(Order $order)
    {
        return $this->frFormatAmount($this->tva($order));
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getEnTVA(Order $order)
    {
        return $this->enFormatAmount($this->tva($order));
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getBigTotal(Order $order)
    {
        return $this->formatAmount($this->getTotalInOrder($order) - $order->discount);
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getFrBigTotal(Order $order)
    {
        return $this->frFormatAmount($this->getTotalInOrder($order) - $order->discount);
    }

    /**
     * @param Order $order
     * @return string
     */
    public function getEnBigTotal(Order $order)
    {
        return $this->enFormatAmount($this->getTotalInOrder($order) - $order->discount);
    }

    /**
     * @param Order $order
     * @return float|int
     */
    private function tva(Order $order)
    {
        return ($this->getTotalInOrder($order) * $this->getTVAPercentage()) / 100;
    }

}