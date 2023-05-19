<?php

namespace App\Listeners\Order;

use App\Enums\UserRoleEnum;
use App\Events\Order\OrderCreated as OrderCreatedEvent;
use App\Mail\Admin\OrderCreated as AdminOrderCreated;
use App\Mail\Customer\OrderCreated as ClientOrderCreated;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use Throwable;

class SendOrderCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderCreatedEvent $event): void
    {
        try {
            $admins = User::where('role', UserRoleEnum::Administrator)->pluck('email');

            Mail::to($admins)->send(new AdminOrderCreated($event->order));
            Mail::to($event->order->details['contact']['email'])->send(new ClientOrderCreated($event->order));
        } catch (Throwable $exception) {
            // TODO notify about notification error
        }
    }
}
