<?php

namespace App\Mail\Customer;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Order $order)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('mail.customer.order.created.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.customer.order-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
