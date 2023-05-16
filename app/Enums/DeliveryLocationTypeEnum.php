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
            self::StorageShed,
        ])->map(fn ($it) => [
            'key' => $it->value,
            'value' => trans('forms.location_types.'.$it->value),
        ])->toArray();
    }

    public function getName(): string
    {
        return match ($this) {
            self::LivingPlace => trans('forms.location_types.'.self::LivingPlace->value),
            self::OfficeBuilding => trans('forms.location_types.'.self::OfficeBuilding->value),
            self::StorageShed => trans('forms.location_types.'.self::StorageShed->value),
        };
    }
}
