<?php

namespace App\Traits;

trait DescriptionTrait
{
    /**
     * @return mixed
     */
    public function getDescriptionAttribute()
    {
        return ucfirst($this->description);
    }
}