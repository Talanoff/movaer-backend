<?php

namespace App\Enums;

enum UserVendorRoleEnum: int
{
    case Owner = 0;
    case Manager = 1;
    case Employee = 2;
}
