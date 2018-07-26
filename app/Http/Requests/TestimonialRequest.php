<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
            'fr_description' => $this->required_text,
            'en_description' => $this->required_text,
            'image' => 'dimensions:width=165,height=160|max:2048'
        ];
    }
}
