<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'receive_email_from_contact', 'receive_email_from_order', 'tva',
        'receive_email_from_register', 'is_activated'
    ];
}
