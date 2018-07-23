<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'en_description' => $this->required_text
        ];
    }
}
