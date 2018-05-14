<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

trait LocaleDateTrait
{
    /**
     * @return mixed
     */
    public function getDateAttribute()
    {
        $date = new Carbon($this->updated_at);
        $format = '';

        if(App::getLocale() === 'fr') $format = 'd/m/Y';
        else if (App::getLocale() === 'en') $format = 'm/d/Y';

        return $date->format($format);
    }
}