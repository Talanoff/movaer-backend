<?php

namespace App\Enums;

enum UserVendorRoleEnum: int
{
    case Owner = 0;
    case Manager = 1;
    case Employee = 2;

    public function getName(): string
    {
        return match ($this) {
            self::Owner => trans('auth.roles.owner'),
            self::Manager => trans('auth.roles.manager'),
            self::Employee => trans('auth.roles.employee'),
        };
    }

    public static function toArray(): array
    {
        return [
            self::Owner->value => trans('auth.roles.owner'),
            self::Manager->value => trans('auth.roles.manager'),
            self::Employee->value => trans('auth.roles.employee'),
        ];
    }
}
