<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed quantity
 */
class UserInfoUpdateRequest extends FormRequest
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
            'first_name' => $this->required_string,
            'last_name' => $this->required_string,
            'post_code' => $this->required_string,
            'city' => $this->required_string,
            'country' => $this->required_string,
            'phone' => $this->required_string,
            'address' => $this->required_string
        ];
    }
}
