<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use SlugRouteTrait, LocaleAmountTrait, LocaleDateTimeTrait;

    const ORDERED = 0;
    const CANCELED = 1;
    const SOLD = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'status'
    ];

    /**
     * Boot functions
     */
    protected static function boot()
    {
        static::creating(function ($order) {
            $order->slug = str_slug($order->reference);
        });

        static::updating(function ($order) {
            $order->slug = str_slug($order->reference);
        });
    }
}
