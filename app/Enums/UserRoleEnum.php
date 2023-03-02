<?php

namespace App\Enums;

enum UserRoleEnum
{
    case Administrator;
    case Manager;
    case Vendor;
    case Customer;
}
