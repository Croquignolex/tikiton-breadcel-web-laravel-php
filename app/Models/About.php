<?php

namespace App\Models;

use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

/** 
 * @property mixed image
 * @property mixed extension
 */
class About extends Model
{
    use LocaleDateTimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image', 'extension', 'about_section_1_normal_zone',
        'about_section_1_important_zone', 'about_section_2_normal_zone',
        'about_section_2_important_zone'
    ];

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return banners_img_asset($this->image, $this->extension);
    }
}
