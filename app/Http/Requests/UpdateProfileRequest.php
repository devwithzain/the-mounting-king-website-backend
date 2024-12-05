<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Allow access; adjust if necessary
    }

    public function rules()
    {
        return [
            'name' => 'string|max:255',
            'email' => 'email,' . $this->user()->id,
        ];
    }
}