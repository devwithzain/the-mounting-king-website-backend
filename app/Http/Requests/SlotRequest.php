<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlotRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'days' => 'required|array|min:1',
            'days.*' => 'string',
            'timings' => 'required|array|min:1',
            'timings.*' => 'string',
            'is_active' => 'required|boolean',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The title field is required!',
            'description.required' => 'The description field is required!',
            'days.required' => 'At least one day is required.',
            'timings.required' => 'At least one time is required.',
            'days.array' => 'Days must be an array.',
            'timings.array' => 'Timings must be an array.',
            'is_active' => 'Is active field is required.',
        ];
    }
}