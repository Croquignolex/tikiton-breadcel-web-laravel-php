<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleSlugSaveTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed products
 * @property mixed format_name
 */
class ProductCategory extends Model
{
    use SlugRouteTrait, LocaleNameTrait,
        LocaleSlugSaveTrait, LocaleDateTimeTrait;

    const ALL = 0;
    const HAS_PRODUCTS = 1;
    const HAS_NO_PRODUCTS = 2;

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
