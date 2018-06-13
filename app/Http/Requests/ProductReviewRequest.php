<?php

namespace App\Http\Requests;

use App\Traits\RequestTrait;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed review
 * @property mixed ranking
 */
class ProductReviewRequest extends FormRequest
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
            'review' => $this->required_text,
            'ranking' => 'required'
        ];
    }
    //|between|min:0|max:5
}
