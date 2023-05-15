<?php

namespace App\Data;

use App\Enums\UserRoleEnum;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\{Data, Optional};

class UserData extends Data
{
    public string $name;

    public string|null|Optional $password = null;

    public UserRoleEnum $role;

    public string $locale;

    public function __construct(
        #[MapOutputName('email')]
        public string|Optional $personalEmail,

        #[MapOutputName('phone')]
        public string|Optional $personalPhone,

        #[MapOutputName('email')]
        public string|Optional $email,

        #[MapOutputName('phone')]
        public string|Optional $phone,
    )
    {
        //
    }
}
