<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $en = json_decode(file_get_contents(database_path('datasets/countries/en.json')));
        $nl = json_decode(file_get_contents(database_path('datasets/countries/nl.json')));
        $nl = array_column($nl, null, 'alpha3');

        foreach ($en as $country) {
            Country::updateOrCreate([
                'alpha3' => $country->alpha3,
            ], [
                'name' => [
                    'en' => $country->name,
                    'nl' => $nl[$country->alpha3]->name,
                ],
                'alpha2' => $country->alpha2,
            ]);
        }
    }
}
