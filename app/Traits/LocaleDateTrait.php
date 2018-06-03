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
        return $date->format($this->dateFormat(App::getLocale()));
    }

    /**
     * @return mixed
     */
    public function getFrCreatedDateAttribute()
    {
        $date = new Carbon($this->created_at);
        return $date->format($this->dateFormat('fr'));
    }

    /**
     * @return mixed
     */
    public function getUpdatedDateAttribute()
    {
        $date = new Carbon($this->updated_at);
        return $date->format($this->dateFormat(App::getLocale()));
    }

    /**
     * @return mixed
     */
    public function getFrUpdatedDateAttribute()
    {
        $date = new Carbon($this->updated_at);
        return $date->format($this->dateFormat('fr'));
    }

    private function dateFormat($locale)
    {
        if($locale === 'fr') return 'd/m/Y';
        else if ($locale === 'en') return 'm/d/Y';
    }
}