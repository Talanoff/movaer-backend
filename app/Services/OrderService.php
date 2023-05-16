<?php

namespace App\Services;

use App\Data\OrderData;
use App\Data\OrderDetailsData;
use App\Data\UserData;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderService
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

        return $order;
    }
}
