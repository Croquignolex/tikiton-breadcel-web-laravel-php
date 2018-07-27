<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use App\Traits\LocaleSlugSaveTrait;
use Illuminate\Support\Facades\Auth;
use App\Traits\LocaleDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed tags
 * @property mixed stock
 * @property mixed image
 * @property mixed price
 * @property int ranking
 * @property mixed pivot
 * @property mixed is_new
 * @property mixed orders
 * @property mixed fr_name
 * @property mixed en_name
 * @property mixed discount
 * @property mixed extension
 * @property mixed created_at
 * @property mixed is_featured
 * @property mixed format_name
 * @property mixed carted_users
 * @property mixed wished_users
 * @property mixed product_tags
 * @property mixed availability
 * @property mixed is_a_discount
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

    const ALL = 0;
    const IS_NEW = 1;
    const IS_FEATURED = 2;
    const IS_BEST_SELLER = 3;
    const IS_OUT_OF_STOCK = 4;
    const IN_STOCk = 'in_stock';
    const OUT_OF_STOCK = 'out_of_stock';
    const SORT_BY_NAME_ASC = 'name_asc';
    const SORT_BY_NAME_DESC = 'name_desc';
    const SORT_BY_PRICE_ASC = 'price_asc';
    const SORT_BY_PRICE_DESC = 'price_desc';
    const SORT_BY_RANKING_ASC = 'ranking_asc';
    const SORT_BY_RANKING_DESC = 'ranking_desc';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'fr_name', 'en_name', 'fr_description', 'en_description',
        'price', 'discount', 'ranking', 'is_featured', 'is_new',
        'is_most_sold', 'stock', 'extension', 'product_category_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product_category()
    {
        return $this->belongsTo('App\Models\ProductCategory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviewed_users()
    {
        return $this->belongsToMany('App\Models\User', 'product_reviews')
            ->withPivot('text', 'ranking')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_products')
            ->withPivot('quantity')->withTimestamps();
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
    public function order_products()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tags')
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wished_users()
    {
        return $this->belongsToMany('App\Models\User', 'user_wish_lists')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_wish_lists()
    {
        return $this->hasMany('App\Models\UserWishList');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carted_users()
    {
        return $this->belongsToMany('App\Models\User', 'user_carts')
            ->withPivot('quantity')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_carts()
    {
        return $this->hasMany('App\Models\UserCart');
    }

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return product_img_asset($this->image, $this->extension);
    }

    /**
     * @return mixed
     */
    public function getAvailabilityAttribute()
    {
        if($this->stock <= 0) return static::OUT_OF_STOCK;
        else return static::IN_STOCk;
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
     * @return bool
     */
    public function getRankingAttribute()
    {
        if($this->product_reviews->count() === 0) return 0;
        else return floor($this->product_reviews->sum('ranking') / $this->product_reviews->count());
    }

    /**
     * @return bool
     */
    public function getIsInCurrentUserCartAttribute()
    {
        $users_who_has_this_product_in_their_cart = $this->carted_users;
        return $users_who_has_this_product_in_their_cart->contains(Auth::user());
    }

    /**
     * @return bool
     */
    public function getIsInCurrentUserWishListAttribute()
    {
        $users_who_has_this_product_in_their_wish_list = $this->wished_users;
        return $users_who_has_this_product_in_their_wish_list->contains(Auth::user());
    }

    /**
     * @return string
     */
    public function getCartLineValueAttribute()
    {
        return $this->formatAmount($this->calculateProductValue());
    }

    /**
     * @return string
     */
    public function getFrCartLineValueAttribute()
    {
        return $this->frFormatAmount($this->calculateProductValue());
    }

    /**
     * @return string
     */
    public function getEnCartLineValueAttribute()
    {
        return $this->enFormatAmount($this->calculateProductValue());
    }

    /**
     * @return string
     */
    public function getCartDiscountLineValueAttribute()
    {
        return $this->formatAmount($this->calculateProductDiscountValue());
    }

    /**
     * @return string
     */
    public function getFrCartDiscountLineValueAttribute()
    {
        return $this->frFormatAmount($this->calculateProductDiscountValue());
    }

    /**
     * @return string
     */
    public function getEnCartDiscountLineValueAttribute()
    {
        return $this->enFormatAmount($this->calculateProductDiscountValue());
    }

    /**
     * @return mixed
     */
    public function getRelatedProductsAttribute()
    {
        return Product::where('id', '<>', $this->id)->get()->filter(function (Product $product) {
            foreach ($product->product_tags as $current_product_tag)
            {
                foreach ($this->product_tags as $this_product_tag)
                {
                    if($current_product_tag->tag_id === $this_product_tag->tag_id)
                    {
                        return true;
                    }
                }
            }
            return false;
        });
    }

    /**
     * @return float|int
     */
    public function calculateProductValue()
    {
        return $this->price * $this->pivot->quantity;
    }

    /**
     * @return float|int
     */
    public function calculateProductDiscountValue()
    {
        $discount = ($this->price * $this->discount) / 100;
        return ($this->price - $discount) * $this->pivot->quantity;
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