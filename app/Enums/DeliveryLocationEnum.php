<?php

namespace App\Enums;

enum DeliveryLocationEnum: int
{
    case LivingPlace = 0;
    case OfficeBuilding = 1;
    case StorageShed = 2;
}
