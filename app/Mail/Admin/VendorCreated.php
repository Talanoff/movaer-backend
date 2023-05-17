<?php

namespace App\Mail\Admin;

use App\Models\Vendor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VendorCreated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Vendor $vendor)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('mail.vendor.created.subject'),
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.admin.vendor-created',
        );
    }
}
