<?php

namespace Database\Factories;

use App\Enums\DeliveryCategoryEnum;
use App\Enums\DeliveryLocationEnum;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function definition(): array
    {
        $pickUpDate = random_int(1, 5);
        $category = DeliveryCategoryEnum::cases()[random_int(0, 3)];

        return [
            'status' => OrderStatusEnum::Created,
            'category' => $category,
            'goods_number' => $category !== DeliveryCategoryEnum::OnePackage ? random_int(1, 4) : null,
            'goods_weight' => $category !== DeliveryCategoryEnum::OnePackage ? random_int(100, 300) : null,
            'description' => $this->faker->sentence(random_int(12, 20)),
            'address_from' => $this->faker->address,
            'address_to' => $this->faker->address,
            'pickup_at' => today()->addDays($pickUpDate),
            'delivery_at' => today()->addDays($pickUpDate + random_int(1, 3)),
            'pickup_location_type' => DeliveryLocationEnum::cases()[random_int(0, 2)],
            'delivery_location_type' => DeliveryLocationEnum::cases()[random_int(0, 2)],
            'options' => [],
        ];
    }
}
