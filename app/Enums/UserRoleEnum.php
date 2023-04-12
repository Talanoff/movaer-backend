<?php

namespace App\Enums;

enum UserRoleEnum: int
{
    case Administrator = 0;
    case Vendor = 1;
    case Customer = 2;
    case Manager = 3;
    case Employee = 4;

    public static function getNames(): array
    {
        return [
            self::Administrator->value => __('roles.administrator'),
            self::Vendor->value => __('roles.vendor'),
            self::Customer->value => __('roles.customer'),
            //            self::Manager->value => __('roles.manager'),
            //            self::Employee->value => __('roles.employee'),
        ];
    }
}
