<?php

namespace App\Models;

use Illuminate\Support\Facades\App;
use App\Traits\LocaleDateTimeTrait;
use Illuminate\Database\Eloquent\Model;

/** 
 * @property mixed image
 * @property mixed extension
 * @property mixed fr_about_section_1_normal_zone
 * @property mixed en_about_section_1_normal_zone
 * @property mixed fr_about_section_2_normal_zone
 * @property mixed en_about_section_2_normal_zone
 * @property mixed fr_about_section_2_important_zone
 * @property mixed en_about_section_2_important_zone
 * @property mixed fr_about_section_1_important_zone
 * @property mixed en_about_section_1_important_zone
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
        'image', 'extension', 'fr_about_section_1_normal_zone',
        'fr_about_section_1_important_zone', 'fr_about_section_2_normal_zone',
        'fr_about_section_2_important_zone',
        'en_about_section_1_normal_zone',
        'en_about_section_1_important_zone', 'en_about_section_2_normal_zone',
        'en_about_section_2_important_zone'
    ];

    /**
     * @return mixed
     */
    public function getAboutSection2ImportantZoneAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_about_section_2_important_zone;
        else if (App::getLocale() === 'en') $name = $this->en_about_section_2_important_zone;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getAboutSection1ImportantZoneAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_about_section_1_important_zone;
        else if (App::getLocale() === 'en') $name = $this->en_about_section_1_important_zone;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getAboutSection2NormalZoneAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_about_section_2_normal_zone;
        else if (App::getLocale() === 'en') $name = $this->en_about_section_2_normal_zone;

        return $name;
    }

    /**
     * @return mixed
     */
    public function getAboutSection1NormalZoneAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_about_section_1_normal_zone;
        else if (App::getLocale() === 'en') $name = $this->en_about_section_1_normal_zone;

        return $name;
    }

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return banners_img_asset($this->image, $this->extension);
    }
}
