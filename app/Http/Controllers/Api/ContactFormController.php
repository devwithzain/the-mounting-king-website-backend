<?php

namespace App\Http\Controllers\Api;

use App\Mail\ContactFormMailer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactFormRequest;

class ContactFormController extends Controller
{
    public function sendForm(ContactFormRequest $request)
    {
        $data = $request->validated();
        $email = 'info@themountingking.com';
        $subject = "You'r request has been submitted successfully";

        try {
            Mail::to($email)->send(new ContactFormMailer($subject, $data));
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send email. Please try again later.'], 500);
        }
        return response()->json(['success' => "You'r request has been submitted successfully."], 200);
    }
}