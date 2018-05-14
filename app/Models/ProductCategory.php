<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use SlugRouteTrait, LocaleNameTrait,
        LocaleSlugSaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fr_name', 'en_name',
        'fr_description', 'en_description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
