<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleNameTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use App\Traits\LocaleSlugSaveTrait;
use App\Utils\AmountSeparator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
 * @property mixed format_name
 * @property mixed carted_users
 * @property mixed wished_users
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviewed_users()
    {
        return $this->belongsToMany('App\Models\User', 'product_reviews')
            ->withPivot('text', 'ranking')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_reviews()
    {
        return $this->hasMany('App\Models\ProductReview');
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
        return product_img_asset($this->image);
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
     * @return bool
     */
    public function getRankingAttribute()
    {
        if($this->product_reviews->count() === 0) return 0;
        else return $this->product_reviews->sum('ranking') / $this->product_reviews->count();
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
     * @return mixed
     */
    public function getRelatedProductsAttribute()
    {
        return Product::where('id', '<>', $this->id)->get()->filter(function ($value) {
            foreach ($value->product_tags as $current_product_tag)
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
}