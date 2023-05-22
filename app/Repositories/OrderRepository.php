<?php

namespace App\Repositories;

use App\Data\OrderData;
use App\Data\OrderDetailsData;
use App\Models\Order;
use App\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class OrderRepository
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MediaService $mediaService
    ) {
        //
    }

    public function store(Collection $data): Model|Order
    {
        $this->userRepository->fill($data);

        $user = $this->userRepository->getUser();

        $orderAttributes = OrderData::from($data);
        $orderAttributes->details = OrderDetailsData::from(
            $data->merge([
                'contact' => $user->only([
                    'name', 'email', 'phone', 'locale',
                ]),
            ])
        );

        $order = new Order($orderAttributes->toArray());

        if ($data->get('registrationRequired')) {
            $this->userRepository->store();
            $order->user_id = $this->userRepository->getUser()->getKey();
        }

        tap($order)->save();

        $this->mediaService->fromBase64(
            $order,
            $data->get('additionalWishesAttachment', []),
            'attachments'
        );

        return $order;
    }
}
