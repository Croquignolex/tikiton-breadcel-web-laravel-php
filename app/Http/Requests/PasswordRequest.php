<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'old_password' => $this->required_string,
            'password' => $this->required_string . '|confirmed'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'password.confirmed' => trans('password_unconfirmed')
        ];
    }
}