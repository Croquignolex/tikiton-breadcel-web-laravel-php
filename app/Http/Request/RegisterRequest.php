<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed'
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
