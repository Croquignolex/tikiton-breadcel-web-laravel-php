<?php

namespace App\Services;

use App\Models\Setting;
use App\Traits\LocaleAmountTrait;
use Illuminate\Support\Facades\Auth;

class CartService
{
    use LocaleAmountTrait;

    /**
     * @return string
     */
    public function getSubTotal()
    {
        return $this->formatAmount(Auth::user()->getTotalInCart() - $this->tva());
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
     * @return string
     */
    public function getTVA()
    {
        return $this->formatAmount($this->tva());
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public function getCouponCode()
    {
        return $this->hasCoupon() ? '(' . session('coupon')->code . ')' : '';
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public function getCouponDiscount()
    {
        return $this->formatAmount($this->coupon());
    }

    /**
     * @return string
     */
    public function getBigTotal()
    {
        return $this->formatAmount(Auth::user()->getTotalInCart() - $this->coupon());
    }

    /**
     * @return float|int
     */
    private function tva()
    {
        return (Auth::user()->getTotalInCart() * $this->getTVAPercentage()) / 100;
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|int|mixed
     */
    private function coupon()
    {
        return $this->hasCoupon() ? session('coupon')->discount : 0;
    }

    /**
     * @return bool
     */
    private function hasCoupon()
    {
        if(session()->has('coupon'))
        {
            if(Auth::user()->getTotalInCart() > session('coupon')->discount)
                return true;
            else session()->forget(['coupon']);
        }

        return false;
    }
}