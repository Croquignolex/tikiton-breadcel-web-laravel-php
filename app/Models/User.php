<?php

namespace App\Models;

use App\Traits\LocaleDateTimeTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed id
 * @property mixed city
 * @property mixed phone
 * @property mixed email
 * @property mixed token
 * @property mixed orders
 * @property mixed country
 * @property mixed company
 * @property mixed address
 * @property mixed is_admin
 * @property mixed password
 * @property mixed last_name
 * @property mixed post_code
 * @property mixed first_name
 * @property mixed is_confirmed
 * @property mixed is_super_admin
 * @property mixed carted_products
 * @property mixed format_last_name
 * @property mixed format_first_name
 */
class User extends Authenticatable
{
    use LocaleDateTimeTrait;

    const ALL = 0;
    const CUSTOMER_HAS_ORDER = 1;
    const CUSTOMER_HAS_NOT_ORDER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password', 'first_name', 'last_name', 'post_code',
        'city', 'country', 'phone', 'company', 'shipping_address', 'address',
        'shipping_city', 'shipping_country', 'shipping_post_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'is_confirmed', 'is_admin', 'is_super_admin', 'email'
    ];

    /**
     * Boot functions
     */
    protected static function boot()
    {
        static::creating(function ($user) {
            $user->token = str_random(64);
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
            ->withPivot('is_activated')->withTimestamps();
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

    /**
     * @return mixed
     */
    public function getFormatFirstNameAttribute()
    {
        return ucfirst($this->first_name);
    }

    /**
     * @return mixed
     */
    public function getFormatLastNameAttribute()
    {
        return mb_strtoupper($this->last_name);
    }

    /**
     * @return mixed
     */
    public function getFormatFullNameAttribute()
    {
        return $this->format_first_name . ' ' . $this->format_last_name;
    }

    /**
     * @return mixed
     */
    public function getFunctionAttribute()
    {
        if($this->is_super_admin) return 'Super administrateur';
        elseif($this->is_admin) return 'Administrateur';

        return 'Client';
    }

    /**
     * @return mixed
     */
    public function getSelectTextAttribute()
    {
        return $this->format_first_name;
    }

    /**
     * @return mixed
     */
    public function getSelectSubtextAttribute()
    {
        return $this->format_last_name;
    }
}
