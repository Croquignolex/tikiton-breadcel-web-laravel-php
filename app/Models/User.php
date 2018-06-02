<?php

namespace App\Models;

use App\Traits\DescriptionTrait;
use App\Traits\NameTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SlugRouteTrait, NameTrait, DescriptionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
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
        });

        static::updating(function ($user) {
            $user->slug = str_slug($user->email);
        });
    }
}
