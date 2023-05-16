<?php

namespace App\Listeners\Vendor;

use App\Enums\UserRoleEnum;
use App\Mail\Vendor\VendorCreated;
use App\Models\User;
use Mail;

class SendVendorCreatedNotification
{
    public function handle(VendorCreated $event): void
    {
        $admins = User::where('role', UserRoleEnum::Administrator)->pluck('email');

        Mail::to($admins)->send(new VendorCreated($event->vendor));
    }
}
