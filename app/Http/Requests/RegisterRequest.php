<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed name
 * @property mixed email
 * @property mixed password
 */
class RegisterRequest extends FormRequest
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
            'email' => $this->required_string . '|unique:users',
            'password' => $this->required_string . '|confirmed'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'email.unique' => trans('auth.user_existed'),
            'password.confirmed' => trans('password_unconfirmed')
        ];
    }
}
