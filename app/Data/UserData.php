<?php

namespace App\Data;

use App\Enums\UserRoleEnum;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public string $name;

    #[MapOutputName('email')]
    public string $personalEmail;

    #[MapOutputName('phone')]
    public string $personalPhone;

    public string $password;

    public UserRoleEnum $role;

    public string $locale;
}
