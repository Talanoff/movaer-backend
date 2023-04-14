<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Administrator = 0;
    case Vendor = 1;
    case Customer = 2;
    case Manager = 3;
    case Employee = 4;

    public static function names(): array
    {
        return [
            self::Administrator->value => __('forms.users.roles.'.self::Administrator->value),
            self::Vendor->value => __('forms.users.roles.'.self::Vendor->value),
            self::Customer->value => __('forms.users.roles.'.self::Customer->value),
        ];
    }
}
