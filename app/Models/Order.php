<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'reference', 'status', 'discount', 'user_id'
    ];

    /**
     * @return string
     */
    public static function getUniqueOrderReference()
    {
        $reference = 'BC' . now()->year . 'N' . random_int(10000000, 99999999);

        if(static::where(['reference' => $reference])->first() !== null)
            return static::getUniqueOrderReference();

        return $reference;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_products')
            ->withPivot('quantity')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_products()
    {
        return $this->hasMany('App\Models\OrderProduct');
    }

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
