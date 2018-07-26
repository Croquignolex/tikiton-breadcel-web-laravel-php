<?php

namespace App\Models;

use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed code
 * @property mixed users
 * @property mixed promo
 * @property mixed discount
 * @property mixed user_coupons
 */
class Coupon extends Model
{
    use LocaleAmountTrait, LocaleDateTimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'discount',
        'description'
    ];

    /**
     * @return string
     */
    public static function getUniqueCode()
    {
        $code = 'BC' . now()->year . 'C' . random_int(10000000, 99999999);

        if(static::where(['code' => $code])->first() !== null)
            return static::getUniqueCode();

        return $code;
    }

    /**
     * Boot functions
     */
    protected static function boot()
    {
        static::creating(function ($coupon) {
            $coupon->code = static::getUniqueCode();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_coupons')
            ->withPivot('is_activated')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_coupons()
    {
        return $this->hasMany('App\Models\UserCoupon');
    }

    public function getPromoAttribute()
    {
        return $this->formatAmount($this->discount);
    }

    /**
     * @return mixed
     */
    public function getSelectTextAttribute()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getSelectSubtextAttribute()
    {
        return money_currency($this->promo);
    }
}