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
        $subject = "You'r request has been submitted successfully";

        Mail::to($data['email'])->send(new ContactFormMailer($subject, $data));

        return response()->json(['success' => "You'r request has been submitted successfully."], 200);
    }
}