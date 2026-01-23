<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetails;
    public $user;

    public function __construct($orderDetails, $user)
    {
        $this->orderDetails = $orderDetails;
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Order Confirmation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_notification', // Create this view
            with: ['order' => $this->orderDetails, 'user' => $this->user],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
