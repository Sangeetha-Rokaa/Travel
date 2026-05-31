<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;


class BookingAdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public Booking $booking;
    protected string $fromAddress;
    protected string $fromName;

    public function __construct(
        Booking $booking,
        string $fromAddress,
        string $fromName
    ) {
        $this->booking = $booking;
        $this->fromAddress = $fromAddress;
        $this->fromName = $fromName;
    }

    public function build()
    {
        return $this->from($this->fromAddress, $this->fromName)
            ->subject('New Booking Received - ' . $this->booking->booking_ref)
            ->view('emails.booking-admin');
    }
}
