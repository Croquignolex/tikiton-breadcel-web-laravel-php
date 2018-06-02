<?php

namespace App\Models;

use App\Traits\DescriptionTrait;
use App\Traits\LocaleDateTrait;
use App\Traits\NameTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SlugRouteTrait, NameTrait,
        DescriptionTrait, LocaleDateTrait;

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
            $user->token = str_random(64);
        });

        static::updating(function ($user) {
            $user->slug = str_slug($user->email);
        });
    }

    /**
     * @return mixed
     */
    public function getConfirmationLinkAttribute()
    {
        return locale_route('account.confirmation', [
            'email' => $this->email,
            'token' => $this->token
        ]);
    }
}
