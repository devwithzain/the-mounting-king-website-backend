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
            'color' => 'required|string|max:258',
            'size' => 'required|string|max:258',
            'category' => 'required|string|max:258',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
            'images' => 'required|array|min:1', // Ensure at least one image is uploaded
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required!',
            'price.required' => 'The price field is required!',
            'color.required' => 'The price color is required!',
            'size.required' => 'The price size is required!',
            'category.required' => 'The price category is required!',
            'description.required' => 'The description field is required!',
            'shortDescription.required' => 'The short description field is required!',
            'images.required' => 'At least one image is required.',
            'images.array' => 'Images must be an array.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Only jpeg, png, jpg, gif, svg images are allowed.',
        ];
    }
}