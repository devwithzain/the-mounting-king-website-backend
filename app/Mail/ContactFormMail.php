<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $email;
    public $selectedItems;
    public $selectedDate;
    public $selectedAddress;
    public $subject;

    public function __construct($subject, $userDetails, $selectedItems, $selectedDate)
    {
        $this->name = $userDetails['name'];
        $this->phone = $userDetails['phone'];
        $this->email = $userDetails['email'];
        $this->selectedItems = $selectedItems;
        $this->selectedDate = $selectedDate;
        $this->selectedAddress = $userDetails['selectedAddress'];
        $this->subject = $subject;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'email.contact-form',
            with: [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'selectedItems' => $this->selectedItems,
                'selectedDate' => $this->selectedDate,
                'selectedAddress' => $this->selectedAddress,
            ],
        );
    }
    public function attachments(): array
    {
        return [];
    }
}