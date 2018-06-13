<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use SlugRouteTrait, LocaleNameTrait,
        LocaleSlugSaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'tag_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }
}
