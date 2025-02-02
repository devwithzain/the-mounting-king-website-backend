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
        $email = 'info@themountingking.com';
        $subject = "Appointment Confirmation";

        try {
            Mail::to($email)->send(new ContactFormMail($subject, $data, $data['selectedItems'], $data['selectedDate']));
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
        }

        return response()->json(['success' => 'Form submitted successfully. An email has been sent to your address.'], 200);
    }
}