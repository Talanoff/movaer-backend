<?php

namespace App\Listeners\Vendor;

use App\Mail\Vendor\VendorInvitation;

class SendVendorInvitationEmail
{
    public function handle(object $event): void
    {
        \Mail::to($event->vendor->email)->send(new VendorInvitation($event->vendor));
    }
}
