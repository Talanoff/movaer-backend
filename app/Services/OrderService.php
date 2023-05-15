<?php

namespace App\Services;

use App\Data\{OrderData, OrderDetailsData, UserData};
use App\Models\{Order, User};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderService
{
    public function store(Collection $data): Model|Order
    {
        $user = new User(UserData::from($data)->toArray());

        $orderAttributes = OrderData::from($data);
        $orderAttributes->details = OrderDetailsData::from(
            $data->merge(!$data->get('registerCheckbox') ? [
                'contact' => $user->only([
                    'name', 'email', 'phone', 'locale'
                ])
            ] : [])
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
