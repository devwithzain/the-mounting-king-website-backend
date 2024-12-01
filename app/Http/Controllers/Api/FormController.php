<?php

namespace App\Http\Controllers\Api;

use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SendContactFormRequest;

class FormController extends Controller
{
    public function sendContactForm(SendContactFormRequest $request)
    {
        $data = $request->validated();
        $subject = "Appointment Confirmation";

        Mail::to($data['email'])->send(new ContactFormMail($subject, $data, $data['selectedItems'], $data['selectedDate'], $data['selectedAddress']));

        return response()->json(['success' => 'Form submitted successfully. An email has been sent to your address.'], 200);
    }
}