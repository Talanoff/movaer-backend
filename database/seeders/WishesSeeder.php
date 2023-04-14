<?php

namespace Database\Seeders;

use App\Enums\WishCategoryEnum;
use App\Models\Wish;
use Illuminate\Database\Seeder;

class WishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            WishCategoryEnum::Common->value => [
                'Tail lift at pick-up'.
                'Tail lift for delivery',
                'Indoor charging',
                'Unloading inside',
                'Call before pick-up',
                'Call before delivery',
                'Appointment needed for delivery',
                'Urgent/Rush',
                'Forklift needed',
            ],
            WishCategoryEnum::Additional->value => [
                'Part load',
                'Refrigerated transport',
                'Frozen transport',
                'Electric vehicle',
                'Call before pick-up',
            ],
        ];

        foreach ($items as $type => $values) {
            Wish::upsert(
                array_map(static fn ($value) => [
                    'name' => json_encode([
                        'en' => $value,
                    ], JSON_THROW_ON_ERROR),
                    'category' => $type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ], $values),
                ['name', 'category', 'created_at', 'updated_at']
            );
        }
    }
}
