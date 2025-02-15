<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'name' => 'required|string|max:258',
                'email' => 'required|string|unique:employees',
                'address' => 'required|string',
                'phone_number' => 'required|string',
                'state' => 'required|string',
            ];
        } else {
            return [
                'name' => 'nullable|string|max:258',
                'email' => 'nullable|string|unique:employees',
                'address' => 'nullable|string',
                'phone_number' => 'nullable|string',
                'state' => 'nullable|string',
            ];
        }
    }
    public function messages()
    {
        if (request()->isMethod('post')) {
            return [
                'name.required' => 'The name field is required!',
                'email.required' => 'The email field is required!',
                'address.required' => 'The address field is required!',
                'phone_number.required' => 'The phone number field is required!',
                'state.required' => 'The state field is required!',
            ];
        } else {
            return [
                'name.required' => 'The name field is required!',
                'email.required' => 'The email field is required!',
                'address.required' => 'The address field is required!',
                'phone_number.required' => 'The phone number field is required!',
                'state.required' => 'The state field is required!',
            ];
        }
    }
}