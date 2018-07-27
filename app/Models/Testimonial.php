<?php

namespace App\Models;

use App\Traits\NameTrait;
use App\Traits\LocaleDateTimeTrait;
use App\Traits\LocaleDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed image
 * @property mixed extension
 * @property mixed format_name
 */
class Testimonial extends Model
{
    use NameTrait, LocaleDescriptionTrait, LocaleDateTimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'name', 'extension',
        'fr_description', 'en_description'
    ];

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return testimonial_img_asset($this->image, $this->extension);
    }
}
