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
            'facebook' => $this->required_string,
            'twitter' => $this->required_string,
            'linkedin' => $this->required_string,
            'googleplus' => $this->required_string,
            'image' => 'dimensions:width=250,height=270|max:2048'
        ];
    }
}
