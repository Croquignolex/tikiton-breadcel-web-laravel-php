<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'label' => $this->required_string,
            'tva' => $this->required_integer . '|min:0',
            'slogan' => $this->required_string,
            'address_1' => $this->required_string,
            'phone_1' => $this->required_string
        ];
    }
}
