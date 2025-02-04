<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:258',
            'description' => 'required|string',
            'short_description' => 'required|string',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title field is required!',
            'short_description.required' => 'The short description field is required!',
            'description.required' => 'The description field is required!',
            // 'image.required' => 'The image field is required!',
        ];
    }
}