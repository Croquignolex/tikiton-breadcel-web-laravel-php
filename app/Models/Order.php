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

    const ALL = 0;
    const ORDERED = 1;
    const CANCELED = 2;
    const PROGRESS = 3;
    const SOLD = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'status', 'discount', 'user_id', 'shipping_address',
        'shipping_city', 'shipping_country', 'shipping_post_code'
    ];

    /**
     * Boot functions
     */
    protected static function boot()
    {
        static::creating(function ($order) {
            $reference = static::getUniqueReference();
            $order->reference = $reference;
            $order->slug = str_slug($reference);
        });
    }

    /**
     * @return string
     */
    public static function getUniqueReference()
    {
        $reference = 'BC' . now()->year . 'O' . random_int(10000000, 99999999);

        if(static::where(['reference' => $reference])->first() !== null)
            return static::getUniqueReference();

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
            return new OrderStatus('ordered', 30, 'text-theme',
                'bg-theme', 'bg-theme', 'badge-theme',
                '#da7612');
        else if($this->status === static::PROGRESS)
            return new OrderStatus('in_progress', 60, 'text-success',
                'progress-bar-success', 'bg-success',
                'badge-success', '#3c763d');
        else if($this->status === static::CANCELED)
            return new OrderStatus('canceled', 100, 'text-danger',
                'progress-bar-danger', 'bg-danger',
                'badge-danger', '#a94442');
        else if($this->status === static::SOLD)
        return new OrderStatus('sold', 100, 'text-info',
            'progress-bar-info', 'bg-info', 'badge-info',
            '#31708f');

        return new OrderStatus('ordered', 30, 'text-theme',
            'bg-theme', 'bg-theme', 'badge-theme',
            '#da7612');
    }
}
