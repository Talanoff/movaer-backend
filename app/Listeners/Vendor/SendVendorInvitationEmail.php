<?php

namespace App\Listeners\Vendor;

use App\Events\Vendor\VendorCreated;
use App\Mail\Vendor\Invitation;
use Mail;
use Throwable;

class SendVendorInvitationEmail
{
    public function handle(VendorCreated $event): void
    {
        try {
            Mail::to($event->vendor->email)->send(new Invitation($event->vendor));
        } catch (Throwable $exception) {
            // TODO notify about notification error
        }
    }
}
