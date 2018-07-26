<?php

namespace App\Models;

use App\Traits\NameTrait;
use App\Traits\SlugSaveTrait;
use App\Traits\SlugRouteTrait;
use Illuminate\Support\Facades\App;
use App\Traits\LocaleDescriptionTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed image
 * @property mixed extension
 * @property mixed fr_function
 * @property mixed en_function
 */
class Team extends Model
{
    use NameTrait, LocaleDescriptionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'fr_function', 'en_function', 'fr_description', 'extension',
        'facebook', 'twitter', 'linkedin', 'googleplus', 'en_description'
    ];

    /**
     * @return string
     */
    public function getImagePathAttribute()
    {
        return team_img_asset($this->image, $this->extension);
    }

    /**
     * @return mixed
     */
    public function getFormatFunctionAttribute()
    {
        $name = '';

        if(App::getLocale() === 'fr') $name = $this->fr_function;
        else if (App::getLocale() === 'en') $name = $this->en_function;

        return ucfirst($name);
    }
}
