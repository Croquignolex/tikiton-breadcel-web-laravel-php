<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleSlugSaveTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed en_name
 * @property mixed fr_name
 * @property mixed products
 * @property mixed format_name
 * @property mixed product_tags
 */
class Tag extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_tags')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_tags()
    {
        return $this->hasMany('App\Models\ProductTag');
    }

    /**
     * @return mixed
     */
    public function getSelectTextAttribute()
    {
        return ucfirst($this->fr_name);
    }

    /**
     * @return mixed
     */
    public function getSelectSubtextAttribute()
    {
        return ucfirst($this->en_name);
    }
}
