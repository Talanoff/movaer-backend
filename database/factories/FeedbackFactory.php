<?php

namespace Database\Factories;

use App\Models\Feedback;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Feedback>
 */
class FeedbackFactory extends Factory
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
            'message' => $this->faker->text,
            'service_rating' => random_int(1, 5),
            'delivery_rating' => random_int(1, 5),
        ];
    }
}
