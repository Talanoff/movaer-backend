<?php

namespace App\Listeners\Order;

use App\Enums\UserRoleEnum;
use App\Mail\Order\OrderCreated;
use App\Events\Order\OrderCreated as OrderCreatedEvent;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendOrderCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderCreatedEvent $event): void
    {
        $admins = User::where('role', UserRoleEnum::Administrator)->pluck('email');

        Mail::to($admins)->send(new OrderCreated($event->order));
    }
}
