<?php

namespace App\Models;

use App\Traits\DescriptionTrait;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use DescriptionTrait;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_coupons')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_coupons()
    {
        return $this->hasMany('App\Models\UserCoupons');
    }
}