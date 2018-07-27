<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    use RequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => $this->required_string,
            'fr_function' => $this->required_string,
            'en_function' => $this->required_string,
            'fr_description' => $this->required_text,
            'en_description' => $this->required_text,
            'facebook' => $this->required_str . '|min:1|max:255',
            'twitter' => $this->required_str . '|min:1|max:255',
            'linkedin' => $this->required_str . '|min:1|max:255',
            'googleplus' => $this->required_str . '|min:1|max:255',
            'image' => 'dimensions:width=250,height=270|max:2048'
        ];
    }
}
