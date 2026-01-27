<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $status;

    public function __construct($booking, $status)
    {
        $this->booking = $booking;
        $this->status = $status;
    }

    public function envelope(): Envelope
    {
        $subject = match($this->status) {
            'accepted' => 'Your Table Booking Has Been Accepted',
            'rejected' => 'Your Table Booking Has Been Rejected',
            default => 'Booking Update'
        };

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_notification',
            with: ['booking' => $this->booking, 'status' => $this->status],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
