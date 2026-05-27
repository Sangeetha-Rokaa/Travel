<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build(): self
    {
        return $this
            ->from(
                config('mail.from.address', 'no-reply@visitnepal.com'),
                config('mail.from.name',    'Visit Nepal')
            )
            ->subject('New Contact Inquiry: ' . $this->contact->subject)
            ->view('emails.contact-admin');
    }
}
