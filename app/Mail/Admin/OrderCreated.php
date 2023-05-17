<?php

namespace App\Mail\Admin;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Order $order)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('mail.admin.order.created.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.admin.order-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
