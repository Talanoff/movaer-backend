<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Administrator = 0;
    case Vendor = 1;
    case Manager = 2;
    case Employee = 3;
    case Customer = 4;

    public static function getNames(): array
    {
        return [
            self::Administrator->value => __('roles.administrator'),
            self::Vendor->value => __('roles.vendor'),
            self::Manager->value => __('roles.manager'),
            self::Employee->value => __('roles.employee'),
            self::Customer->value => __('roles.customer'),
        ];
    }
}
