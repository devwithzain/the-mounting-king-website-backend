<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'heading' => 'required|string|max:258',
            'subHeading' => 'required|string|max:258',
            'description' => 'required|string|max:258',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ];
    }
    public function messages()
    {
        return [
            'heading.required' => 'The name field is required!',
            'subHeading.required' => 'The subHeading field is required!',
            'description.required' => 'The description field is required!',
            'image.required' => 'The image field is required!',
        ];
    }
}