<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use App\Traits\LocaleDateTimeTrait; 
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed magic
 * @property mixed offer_1
 * @property mixed offer_2
 * @property mixed offer_3
 * @property mixed offer_4
 * @property mixed banner_1
 * @property mixed banner_2
 * @property mixed banner_3
 * @property mixed fr_magic_title
 * @property mixed en_magic_title
 * @property mixed fr_magic_header
 * @property mixed en_magic_header
 * @property mixed magic_extension
 * @property mixed offer_extension_1
 * @property mixed offer_extension_2
 * @property mixed offer_extension_3
 * @property mixed offer_extension_4
 * @property mixed fr_offer_1_text_1
 * @property mixed en_offer_1_text_1
 * @property mixed fr_offer_2_text_1
 * @property mixed en_offer_2_text_1
 * @property mixed fr_offer_3_text_1
 * @property mixed en_offer_3_text_1
 * @property mixed fr_offer_4_text_1
 * @property mixed en_offer_4_text_1
 * @property mixed fr_offer_1_text_2
 * @property mixed en_offer_1_text_2
 * @property mixed fr_offer_2_text_2
 * @property mixed en_offer_2_text_2
 * @property mixed fr_offer_3_text_2
 * @property mixed en_offer_3_text_2
 * @property mixed fr_offer_4_text_2
 * @property mixed en_offer_4_text_2
 * @property mixed fr_banner_1_text_1
 * @property mixed en_banner_1_text_1
 * @property mixed fr_banner_2_text_1
 * @property mixed en_banner_2_text_1
 * @property mixed fr_banner_3_text_1
 * @property mixed en_banner_3_text_1
 * @property mixed fr_banner_1_text_2
 * @property mixed en_banner_1_text_2
 * @property mixed fr_banner_2_text_2
 * @property mixed en_banner_2_text_2
 * @property mixed fr_banner_3_text_2
 * @property mixed en_banner_3_text_2
 * @property mixed banner_extension_1
 * @property mixed banner_extension_2
 * @property mixed banner_extension_3
 * @property mixed fr_magic_description
 * @property mixed en_magic_description
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
        'offer_4', 'offer_extension_4', 'magic', 'magic_extension',
        'fr_banner_1_text_1', 'fr_banner_1_text_2', 'fr_banner_2_text_1',
        'fr_banner_2_text_2', 'fr_banner_3_text_1', 'fr_banner_3_text_2',
        'fr_offer_1_text_1',  'fr_offer_1_text_2', 'fr_offer_2_text_1',
        'fr_offer_2_text_2', 'fr_offer_3_text_1', 'fr_offer_3_text_2',
        'fr_offer_4_text_1', 'fr_offer_4_text_2', 'fr_magic_header',
        'fr_magic_title', 'fr_magic_description',
        'en_banner_1_text_1', 'en_banner_1_text_2', 'en_banner_2_text_1',
        'en_banner_2_text_2', 'en_banner_3_text_1', 'en_banner_3_text_2',
        'en_offer_1_text_1', 'en_offer_1_text_2', 'en_offer_2_text_1',
        'en_offer_2_text_2', 'en_offer_3_text_1', 'en_offer_3_text_2',
        'en_offer_4_text_1', 'en_offer_4_text_2', 'en_magic_header',
        'en_magic_title', 'en_magic_description',
    ];

    /**
     * @return mixed
     */
    public function getMagicDescriptionAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_magic_description;
        else if (App::getLocale() === 'en') $name = $this->en_magic_description;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getMagicTitleAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_magic_title;
        else if (App::getLocale() === 'en') $name = $this->en_magic_title;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getMagicHeaderAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_magic_header;
        else if (App::getLocale() === 'en') $name = $this->en_magic_header;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer4Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_4_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_offer_4_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer4Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_4_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_offer_4_text_1;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer3Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_3_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_offer_3_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer3Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_3_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_offer_3_text_1;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer2Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_2_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_offer_2_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer2Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_2_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_offer_2_text_1;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer1Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_1_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_offer_1_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getOffer1Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_offer_1_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_offer_1_text_1;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getBanner3Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_banner_3_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_banner_3_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getBanner3Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_banner_3_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_banner_3_text_1;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getBanner2Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_banner_2_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_banner_2_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getBanner2Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_banner_2_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_banner_2_text_1;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getBanner1Text2Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_banner_1_text_2;
        else if (App::getLocale() === 'en') $name = $this->en_banner_1_text_2;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getBanner1Text1Attribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_banner_1_text_1;
        else if (App::getLocale() === 'en') $name = $this->en_banner_1_text_1;

        return $name;
    }

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
