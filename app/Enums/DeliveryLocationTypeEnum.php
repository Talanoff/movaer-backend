<?php

namespace App\Enums;

enum DeliveryLocationTypeEnum: int
{
    case LivingPlace = 0;
    case OfficeBuilding = 1;
    case StorageShed = 2;

    public static function toResource(): array
    {
        return collect([
            self::LivingPlace,
            self::OfficeBuilding,
            self::StorageShed
        ])->map(fn($it) => [
            'key' => $it->value,
            'value' => trans('forms.location_types.' . $it->value)
        ])->toArray();
    }
}
