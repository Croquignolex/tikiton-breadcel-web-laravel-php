<?php

namespace App\Models;

use App\Traits\NameTrait;
use App\Traits\SlugSaveTrait;
use App\Traits\SlugRouteTrait;
use App\Traits\DescriptionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed image
 * @property mixed function
 */
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
