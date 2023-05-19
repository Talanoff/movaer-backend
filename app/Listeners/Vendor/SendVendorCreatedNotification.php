<?php

namespace App\Listeners\Vendor;

use App\Enums\UserRoleEnum;
use App\Events\Vendor\VendorCreated as VendorCreatedEvent;
use App\Mail\Admin\VendorCreated;
use App\Models\User;
use Mail;
use Throwable;

class SendVendorCreatedNotification
{
    public function handle(VendorCreatedEvent $event): void
    {
        try {
            $admins = User::where('role', UserRoleEnum::Administrator)->pluck('email');

            Mail::to($admins)->send(new VendorCreated($event->vendor));
        } catch (Throwable $exception) {
            // TODO notify about notification error
        }
    }
}
