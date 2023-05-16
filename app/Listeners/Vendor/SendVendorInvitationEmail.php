<?php

namespace App\Listeners\Vendor;

use App\Events\Vendor\VendorCreated;
use App\Mail\Vendor\VendorInvitation;

class SendVendorInvitationEmail
{
    public function handle(VendorCreated $event): void
    {
        \Mail::to($event->vendor->email)->send(new VendorInvitation($event->vendor));
    }
}
