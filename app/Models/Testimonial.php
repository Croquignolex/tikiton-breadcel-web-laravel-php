<?php

namespace App\Models;

use App\Traits\NameTrait;
use App\Traits\SlugSaveTrait;
use App\Traits\SlugRouteTrait;
use App\Traits\LocaleDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use SlugRouteTrait, NameTrait,
        LocaleDescriptionTrait, SlugSaveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'name',
        'fr_description', 'en_description'
    ];

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return testimonial_img_asset($this->image);
    }
}
