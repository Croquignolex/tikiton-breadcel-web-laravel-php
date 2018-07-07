<?php

namespace App\Models;

use App\Traits\SlugRouteTrait;
use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use App\Utils\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property mixed user
 * @property mixed status
 * @property mixed products
 * @property mixed discount
 * @property mixed reference
 */
class Order extends Model
{
    use SlugRouteTrait, LocaleAmountTrait, LocaleDateTimeTrait;

    const ORDERED = 0;
    const CANCELED = 1;
    const PROGRESS = 2;
    const SOLD = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'status', 'discount', 'user_id'
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
     * @return mixed
     */
    public function getFormatStatusAttribute()
    {
        if($this->status === static::ORDERED)
            return new OrderStatus('ordered', 30, 'text-theme', 'bg-theme');
        else if($this->status === static::PROGRESS)
            return new OrderStatus('in_progress', 60, 'text-success', 'progress-bar-success');
        else if($this->status === static::CANCELED)
            return new OrderStatus('canceled', 100, 'text-danger', 'progress-bar-danger');
        else if($this->status === static::SOLD)
        return new OrderStatus('sold', 100, 'text-info', 'progress-bar-info');

        return new OrderStatus('ordered', 30, 'text-theme', 'bg-theme');
    }
}
