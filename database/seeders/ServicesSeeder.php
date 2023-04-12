<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Passenger Car',
            'Distribution',
            'Construction materials',
            'Exceptional',
            'Intermodal freight',
            'International',
            'Tip-truck Courier',
            'Foodstuffs',
            'Agricultural',
            'Flori-culture',
            'Rail',
            'Tank and silo',
            'Movers Stores',
            'Distribution Sea container',
            'Waste materials',
        ];

        foreach ($services as $service) {
            Service::create([
                'name' => $service,
            ]);
        }
    }
}
