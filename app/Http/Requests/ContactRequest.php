<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'email' => $this->required_email,
            'phone' => $this->required_string,
            'subject' => $this->required_string,
            'message' => $this->required_text,
        ];
    }
}