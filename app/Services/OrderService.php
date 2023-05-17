<?php

namespace App\Services;

use App\Data\OrderData;
use App\Data\OrderDetailsData;
use App\Data\UserData;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Log;
use Throwable;

final class OrderService
{
    public function store(Collection $data): Model|Order
    {
        $user = new User(UserData::from($data)->toArray());

        $orderAttributes = OrderData::from($data);
        $orderAttributes->details = OrderDetailsData::from(
            $data->merge([
                'contact' => $user->only([
                    'name', 'email', 'phone', 'locale',
                ]),
            ])
        );

        $order = new Order($orderAttributes->toArray());

        if ($data->get('registerCheckbox')) {
            tap($user)->save();
            $order->user_id = $user->getKey();
        }

        tap($order)->save();

        $this->saveAttachments($data, $order);

        return $order;
    }

    private function saveAttachments(Collection $data, Order $order): void
    {
        try {
            if (count($attachments = $data->get('additionalWishesAttachment', []))) {
                foreach ($attachments as $attachment) {
                    $extension = explode('/', mime_content_type($attachment))[1];

                    $order->addMediaFromBase64($attachment)
                        ->usingFileName(md5(time()) . ($extension ? ".$extension" : '.png'))
                        ->toMediaCollection('attachments');
                }
            }
        } catch (Throwable $exception) {
            Log::error($exception->getMessage(), ['Order', 'Attachments']);
        }
    }
}
