<?php

namespace App\Models;

use App\Traits\LocaleAmountTrait;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 * @property mixed tva
 * @property mixed label
 * @property mixed is_activated
 */
class Setting extends Model
{
    use LocaleAmountTrait, LocaleDateTimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receive_email_from_contact', 'receive_email_from_new_order', 'tva',
        'receive_email_from_canceled_order', 'receive_email_from_register',
        'label', 'slogan', 'address_1', 'address_2', 'phone_1', 'phone_2',
        'facebook', 'twitter', 'linkedin', 'googleplus', 'youtube',
        'order_activated'
    ];

    /**
     * @return mixed
     */
    public function getFormatTvaAttribute()
    {
        return $this->formatAmount($this->tva);
    }
}
