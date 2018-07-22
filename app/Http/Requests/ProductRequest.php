<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'fr_name' => $this->required_string,
            'en_name' => $this->required_string,
            'fr_description' => $this->required_text,
            'en_description' => $this->required_text,
            'price' => $this->required_integer . '|min:0',
            'discount' => $this->required_integer . '|min:0|max:100',
            'stock' => $this->required_integer . '|min:0',
            'category' => $this->required_integer,
            'tags' => 'array',
            'image' => 'dimensions:width=600,height=500|max:2048'
        ];
    }
}
