<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendContactFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'selectedItems' => 'required|array',
            'selectedItems.*.quantity' => 'required|integer|min:1',
            'selectedItems.*.price' => 'required|numeric|min:0',
            'selectedItems.*.time' => 'required|integer|min:1',
            'selectedDate' => 'required|array',
            'selectedDate.day' => 'required|string',
            'selectedDate.date' => 'required|string',
            'selectedAddress' => 'required|array',
            'selectedAddress.address' => 'required|string|max:255',
            'selectedAddress.aptUnitFloor' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone number field is required.',
            'email.required' => 'The email field is required.',
            'selectedItems.required' => 'You must select at least one item.',
            'selectedDate.required' => 'The appointment date is required.',
            'selectedAddress.required' => 'The address field is required.',
        ];
    }
}