<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class VendorLocationData extends Data
{
    #[MapOutputName('country_id')]
    public int $country;

    #[MapOutputName('name')]
    public string $city;
}
