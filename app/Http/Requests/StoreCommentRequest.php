<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'text' => ['string'],
            'rating' => ['required', 'integer'],
            'professor' => ['required'],
            'difficulty' => ['required'],
            'again' => ['required'],
        ];
    }
}
