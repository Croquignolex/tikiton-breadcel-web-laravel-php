<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed products
 * @property mixed format_name
 */
class Tag extends Model
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
}
