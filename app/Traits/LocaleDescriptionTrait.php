<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait LocaleDescriptionTrait
{
    /**
     * @return mixed
     */
    public function getDescriptionAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_description;
        else if (App::getLocale() === 'en') $name = $this->en_description;

        return title_case($name);
    }
}