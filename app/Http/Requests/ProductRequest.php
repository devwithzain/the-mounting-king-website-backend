<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:258',
            'price' => 'required|string|max:258',
            'description' => 'required|string|max:258',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required!',
            'price.required' => 'The price field is required!',
            'description.required' => 'The description field is required!',
            'image.required' => 'The image field is required!',
        ];
    }
}