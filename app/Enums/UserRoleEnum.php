<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Administrator = 0;
    case Customer = 1;

    public static function names(): array
    {
        return [
            self::Administrator->value => __('forms.users.roles.'.self::Administrator->value),
            self::Customer->value => __('forms.users.roles.'.self::Customer->value),
        ];
    }
}
