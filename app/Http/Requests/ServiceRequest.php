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
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required!',
            'description.required' => 'The description field is required!',
        ];
    }
}