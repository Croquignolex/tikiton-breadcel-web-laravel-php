<?php

namespace App\Models;

use App\Traits\LocaleDateTimeTrait; 
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed magic
 * @property mixed magic_extension
 * @property mixed banner_1
 * @property mixed banner_extension_1
 * @property mixed banner_2
 * @property mixed banner_extension_2
 * @property mixed banner_3
 * @property mixed banner_extension_3
 * @property mixed offer_1
 * @property mixed offer_extension_1
 * @property mixed offer_2
 * @property mixed offer_extension_2
 * @property mixed offer_3
 * @property mixed offer_extension_3
 * @property mixed offer_4
 * @property mixed offer_extension_4
 */
class Home extends Model
{
    use LocaleDateTimeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_1', 'banner_extension_1', 'banner_2', 'banner_extension_2',
        'banner_3', 'banner_extension_3', 'offer_1', 'offer_extension_1',
        'offer_2', 'offer_extension_2', 'offer_3', 'offer_extension_3',
        'offer_4', 'offer_extension_4', 'magic', 'magic_extension', 'magic_description',
        'banner_1_text_1', 'banner_1_text_2', 'banner_2_text_1', 'banner_2_text_2',
        'banner_3_text_1', 'banner_3_text_2', 'offer_1_text_1', 'offer_1_text_2',
        'offer_2_text_1', 'offer_2_text_2', 'offer_3_text_1', 'offer_3_text_2',
        'offer_4_text_1', 'offer_4_text_2', 'magic_header', 'magic_title'
    ];

    /**
     * @return string
     */
    public function getMagicImagePathAttribute()
    {
        return banners_img_asset($this->magic, $this->magic_extension);
    }

    /**
     * @return string
     */
    public function getBanner1ImagePathAttribute()
    {
        return banners_img_asset($this->banner_1, $this->banner_extension_1);
    }

    /**
     * @return string
     */
    public function getBanner2ImagePathAttribute()
    {
        return banners_img_asset($this->banner_2, $this->banner_extension_2);
    }

    /**
     * @return string
     */
    public function getBanner3ImagePathAttribute()
    {
        return banners_img_asset($this->banner_3, $this->banner_extension_3);
    }

    /**
     * @return string
     */
    public function getOffer1ImagePathAttribute()
    {
        return banners_img_asset($this->offer_1, $this->offer_extension_1);
    }

    /**
     * @return string
     */
    public function getOffer2ImagePathAttribute()
    {
        return banners_img_asset($this->offer_2, $this->offer_extension_2);
    }

    /**
     * @return string
     */
    public function getOffer3ImagePathAttribute()
    {
        return banners_img_asset($this->offer_3, $this->offer_extension_3);
    }

    /**
     * @return string
     */
    public function getOffer4ImagePathAttribute()
    {
        return banners_img_asset($this->offer_4, $this->offer_extension_4);
    }
}
