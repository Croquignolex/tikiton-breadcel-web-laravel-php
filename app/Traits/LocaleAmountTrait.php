<?php

namespace App\Traits;

use App\Utils\AmountSeparator;
use Illuminate\Support\Facades\App;

trait LocaleAmountTrait
{
    /**
     * @return string
     */
    public function getAmountAttribute()
    {
        return $this->formatAmount($this->price);
    }

    /**
     * @return string
     */
    public function getNewPriceAttribute()
    {
        $discount = ($this->price * $this->discount) / 100;
        return $this->formatAmount($this->price - $discount);
    }

    /**
     * @param $amount
     * @return string
     */
    private function formatAmount($amount)
    {
        $separator = new AmountSeparator();

        if(App::getLocale() === 'fr')
        {
            $separator->decimals = ',';
            $separator->thousands = '.';
        }
        else if (App::getLocale() === 'en')
        {
            $separator->decimals = '.';
            $separator->thousands = ',';
        }

        return number_format(
            $amount, 2,
            $separator->decimals,
            $separator->thousands
        );
    }
}