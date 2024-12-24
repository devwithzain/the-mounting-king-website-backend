<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HeroProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:258',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required!',
        ];
    }
}