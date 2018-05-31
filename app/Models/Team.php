<?php

namespace App\Models;

use App\Traits\DescriptionTrait;
use App\Traits\NameTrait;
use App\Traits\SlugRouteTrait;
use App\Traits\SlugSaveTrait;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use NameTrait, DescriptionTrait, SlugRouteTrait, SlugSaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'function', 'description',
        'facebook', 'twitter', 'linkedin', 'googleplus'
    ];

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return team_img_asset($this->image);
    }

    /**
     * @return mixed
     */
    public function getFormatFunctionAttribute()
    {
        return strtoupper($this->function);
    }
}
