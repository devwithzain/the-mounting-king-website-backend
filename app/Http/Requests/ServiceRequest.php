<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'title' => 'required|string|max:258',
                'description' => 'required|string',
                'short_description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ];
        } else {
            return [
                'title' => 'required|string|max:258',
                'description' => 'required|string',
                'short_description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            ];
        }
    }
    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'title.required' => 'The title field is required!',
                'short_description.required' => 'The short description field is required!',
                'description.required' => 'The description field is required!',
                'image.required' => 'Image is required!',
            ];
        } else {
            return [
                'title.required' => 'The title field is required!',
                'short_description.required' => 'The short description field is required!',
                'description.required' => 'The description field is required!',
            ];
        }
    }
}