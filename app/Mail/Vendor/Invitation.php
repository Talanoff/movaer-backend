<?php

namespace App\Mail\Vendor;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Vendor $vendor)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('mail.vendor.invitation.subject', ['service' => config('app.name')]),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.vendor.invitation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
