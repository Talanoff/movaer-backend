<?php

namespace App\Repositories;

use App\Data\OrderData;
use App\Data\OrderDetailsData;
use App\Models\Order;
use App\Services\MediaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

final class OrderRepository
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly MediaService $mediaService
    ) {
        //
    }

    public function store(FormRequest $request): Model|Order
    {
        $attributes = $request->validated();

        if (! $user = $request->user('sanctum')) {
            $this->userRepository->fill($attributes);
            $user = $this->userRepository->getUser();
        }

        $orderAttributes = OrderData::from($attributes);
        $orderAttributes->details = OrderDetailsData::from(
            array_merge($attributes, [
                'contact' => (clone $user)->only([
                    'name', 'email', 'phone', 'locale',
                ]),
            ])
        );

        $order = new Order($orderAttributes->toArray());

        if ($request->boolean('registrationRequired')) {
            $this->userRepository->store();
            $order->user_id = $this->userRepository->getUser()->getKey();
        } elseif ($user) {
            $order->user_id = $user->getKey();
        }

        tap($order)->save();

        $this->mediaService->fromBase64(
            $order,
            $request->get('additionalWishesAttachment', []),
            'attachments'
        );

        return $order;
    }
}
