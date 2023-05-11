<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class VendorData extends Data
{
    public string $email;

    public string $phone;

    #[MapOutputName('name')]
    public string $companyName;

    #[MapOutputName('commerce_no')]
    public string $commerceNumber;

    public string $iban;

    public string $vat;

    #[MapOutputName('country_id')]
    public int $country;

    public string $street;

    #[MapOutputName('house_no')]
    public string $houseNumber;

    #[MapOutputName('post_code')]
    public string $postCode;
}
