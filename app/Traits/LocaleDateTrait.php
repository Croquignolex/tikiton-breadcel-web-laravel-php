<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

trait LocaleDateTrait
{
    /**
     * @return mixed
     */
    public function getCreatedDateAttribute()
    {
        $date = new Carbon($this->created_at);
        return $date->format($this->dateFormat());
    }

    /**
     * @return mixed
     */
    public function getUpdatedDateAttribute()
    {
        $date = new Carbon($this->updated_at);
        return $date->format($this->dateFormat());
    }

    private function dateFormat()
    {
        if(App::getLocale() === 'fr') return 'd/m/Y';
        else if (App::getLocale() === 'en') return 'm/d/Y';
    }
}