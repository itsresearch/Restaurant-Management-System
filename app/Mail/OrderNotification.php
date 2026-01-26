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
    public $status;
    public $recipientEmail;

    public function __construct($orderDetails, $user = null, $status = 'confirmed', $recipientEmail = null)
    {
        $this->orderDetails = $orderDetails;
        $this->user = $user;
        $this->status = $status;
        $this->recipientEmail = $recipientEmail;
    }

    public function envelope(): Envelope
    {
        $subject = match($this->status) {
            'confirmed' => 'Your Order Confirmation',
            'on_the_way' => 'Your Order is On the Way!',
            'delivered' => 'Your Order Has Been Delivered',
            'canceled' => 'Your Order Has Been Canceled',
            default => 'Order Update'
        };

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_notification', // Create this view
            with: ['order' => $this->orderDetails, 'user' => $this->user, 'status' => $this->status, 'recipientEmail' => $this->recipientEmail],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
