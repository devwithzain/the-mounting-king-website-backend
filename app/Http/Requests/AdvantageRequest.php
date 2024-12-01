<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvantageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:258',
            'subTitle' => 'required|string|max:258',
            'serviceTitle1' => 'required|string|max:258',
            'serviceTitle2' => 'required|string|max:258',
            'serviceTitle3' => 'required|string|max:258',
            'serviceDescription1' => 'required|string|max:258',
            'serviceDescription2' => 'required|string|max:258',
            'serviceDescription3' => 'required|string|max:258',
            'serviceImage1' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'serviceImage2' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'serviceImage3' => 'required|image|mimes:jpeg,png,jpg,gif,svg',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'The Title field is required!',
            'subTitle.required' => 'The Sub Title field is required!',
            'serviceTitle1.required' => 'The Service Title field is required!',
            'serviceTitle2.required' => 'The Service Title field is required!',
            'serviceTitle3.required' => 'The Service Title field is required!',
            'serviceDescription1.required' => 'The Service Description field is required!',
            'serviceDescription2.required' => 'The Service Description field is required!',
            'serviceDescription3.required' => 'The Service Description field is required!',
            'serviceImage1.required' => 'The Service Image field is required!',
            'serviceImage2.required' => 'The Service Image field is required!',
            'serviceImage3.required' => 'The Service Image field is required!',
        ];
    }
}