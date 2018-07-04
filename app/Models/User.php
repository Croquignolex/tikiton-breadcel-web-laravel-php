<?php

namespace App\Models;

use App\Traits\NameTrait;
use App\Traits\SlugRouteTrait;
use App\Traits\DescriptionTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed id
 * @property mixed name
 * @property mixed email
 * @property mixed token
 * @property mixed password
 * @property mixed carted_products
 */
class User extends Authenticatable
{
    use SlugRouteTrait, NameTrait,
        DescriptionTrait, LocaleDateTimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'first_name', 'last_name', 'post_code',
        'city', 'country', 'phone', 'company', 'shipping_address', 'address',
        'shipping_city', 'shipping_country', 'shipping_post_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Boot functions
     */
    protected static function boot()
    {
        static::creating(function ($user) {
            $user->slug = str_slug($user->email);
            $user->token = str_random(64);
        });

        static::updating(function ($user) {
            $user->slug = str_slug($user->email);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviewed_products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_reviews')
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
    public function wished_products()
    {
        return $this->belongsToMany('App\Models\Product', 'user_wish_lists')
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
    public function carted_products()
    {
        return $this->belongsToMany('App\Models\Product', 'user_carts')
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coupons()
    {
        return $this->belongsToMany('App\Models\Coupon', 'user_coupons')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_coupons()
    {
        return $this->hasMany('App\Models\UserCoupon');
    }

    /**
     * @return mixed
     */
    public function getConfirmationLinkAttribute()
    {
        return locale_route('account.validation', [
            'email' => $this->email, 'token' => $this->token
        ]);
    }

    /**
     * @return string
     */
    public function getTotalInCart()
    {
        return $this->carted_products->sum(function (Product $product) {
            if($product->is_a_discount) return $product->calculateProductDiscountValue();
            else return $product->calculateProductValue();
        });
    }
}
