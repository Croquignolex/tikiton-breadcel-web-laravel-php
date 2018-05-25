<?php

namespace App\Traits;

trait NameTrait
{
    /**
     * @return mixed
     */
    public function getNameAttribute()
    {
        return ucfirst($this->name);
    }
}