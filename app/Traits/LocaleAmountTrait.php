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
            $this->price, 2,
            $separator->decimals,
            $separator->thousands
        );
    }
}