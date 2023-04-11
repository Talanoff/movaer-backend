<?php

namespace Database\Factories;

use App\Models\Vendor;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vendor>
 */
class VendorFactory extends Factory
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
        return [
            'name' => $this->faker->company,
            'about' => $this->faker->sentence,
            'address' => $this->faker->address,
            'employees' => random_int(5, 100),
        ];
    }
}
