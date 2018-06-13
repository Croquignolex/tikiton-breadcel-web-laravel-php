<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Support\Facades\App;
use App\Traits\LocaleDateTimeTrait;
use App\Traits\LocaleDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed stock
 * @property mixed image
 * @property mixed price
 * @property int ranking
 * @property mixed is_new
 * @property mixed discount
 * @property mixed created_at
 * @property mixed product_tags
 * @property mixed product_reviews
 * @property mixed fr_featured_title
 * @property mixed en_featured_title
 * @property mixed en_featured_description
 * @property mixed fr_featured_description
 */
class Product extends Model
{
    use SlugRouteTrait, LocaleNameTrait, LocaleDescriptionTrait,
        LocaleSlugSaveTrait, LocaleAmountTrait, LocaleDateTimeTrait;

    const SORT_BY_PRICE_ASC = 0;
    const SORT_BY_PRICE_DESC = 1;
    const SORT_BY_RANKING_ASC = 2;
    const SORT_BY_RANKING_DESC = 3;
    const SORT_BY_NAME_ASC = 4;
    const SORT_BY_NAME_DESC = 5;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_reviews()
    {
        return $this->hasMany('App\Models\ProductReview');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_tags()
    {
        return $this->hasMany('App\Models\ProductTag');
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

    /**
     * @return mixed
     */
    public function getAvailabilityAttribute()
    {
        if($this->stock <= 0) return 'out_of_stock';
        else return 'in_stock';
    }

    /**
     * @return bool
     */
    public function getIsANewAttribute()
    {
        return $this->is_new ||
            ($this->created_at >= now()->addDay(-7)) ? true : false;
    }

    /**
     * @return bool
     */
    public function getIsADiscountAttribute()
    {
        return $this->discount !== 0 ? true : false;
    }

    /**
     * @return mixed
     */
    public function getRelatedProductsAttribute()
    {
        return Product::where('id', '<>', $this->id)->get()->filter(function ($value){
            foreach ($value->product_tags as $current_product_tag)
            {
                foreach ($this->product_tags as $this_product_tag)
                {
                    if($current_product_tag->tag_id === $this_product_tag->tag_id)
                    {
                        return $value;
                    }
                }
            }
            return null;
        });
    }

    /**
     * @return bool
     */
    public function getRankingAttribute()
    {
        if($this->product_reviews->count() === 0) return 0;
        else return $this->product_reviews->sum('ranking') / $this->product_reviews->count();
    }
}