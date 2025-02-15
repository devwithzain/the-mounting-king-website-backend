<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|max:258',
            'price' => 'required|string|max:258',
            'color' => 'required|string|max:258',
            'size' => 'required|string|max:258',
            'category' => 'required|string|max:258',
            'shortDescription' => 'required|string',
            'description' => 'required|string',
        ];

        if ($this->isMethod('POST')) {
            $rules['image'] = 'required|array|min:1';
            $rules['image.*'] = 'image|mimes:jpeg,png,jpg,gif,svg';
        } else {
            $rules['image'] = 'nullable|array|min:1';
            $rules['image.*'] = 'image|mimes:jpeg,png,jpg,gif,svg';
        }

        return $rules;
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
            'image.required' => 'At least one image is required.',
            'image.array' => 'Image must be an array.',
            'image.*.image' => 'Each file must be an image.',
            'image.*.mimes' => 'Only jpeg, png, jpg, gif, svg images are allowed.',
        ];
    }
}