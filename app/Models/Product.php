<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleDateTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Support\Facades\App;
use App\Traits\LocaleDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SlugRouteTrait, LocaleNameTrait, LocaleDescriptionTrait,
        LocaleSlugSaveTrait, LocaleAmountTrait, LocaleDateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'fr_name', 'en_name', 'fr_description', 'en_description',
        'price', 'discount', 'ranking', 'is_featured', 'is_new',
        'is_most_sold', 'stock'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }


    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return product_img_asset($this->image);
    }

    /**
     * @return string
     */
    public function getNewPriceAttribute()
    {
         $discount = $this->price / $this->discount;
         return round($this->price - $discount, 2);
    }

    /**
     * @return mixed
     */
    public function getFeaturedTitleAttribute()
    {
        $title = '';

        if(App::getLocale() === 'fr') $title = $this->fr_featured_title;
        else if (App::getLocale() === 'en') $title = $this->en_featured_title;

        return ucfirst($title);
    }

    /**
     * @return mixed
     */
    public function getFeaturedDescriptionAttribute()
    {
        $description = '';

        if(App::getLocale() === 'fr') $description = $this->fr_featured_description;
        else if (App::getLocale() === 'en') $description = $this->en_featured_description;

        return ucfirst($description);
    }
}
