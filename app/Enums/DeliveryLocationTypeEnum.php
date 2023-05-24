<?php

namespace App\Enums;

enum DeliveryLocationTypeEnum: int
{
    case ResidentialBuilding = 0;
    case ApartmentBuilding = 1;
    case DistributionCenter = 2;
    case OfficeBuilding = 3;
    case CompanyShed = 4;
    case HealthcareFacility = 5;
    case RecreationArea = 6;
    case GuardedArea = 7;
    case HarborArea = 8;
    case Airport = 9;
    case SomethingDifferent = 10;

    public static function toResource(): array
    {
        return array_map(static fn ($it) => [
            'key' => $it->value,
            'value' => trans('forms.location_types.'.$it->value),
        ], self::cases());
    }

    public function getName(): string
    {
        return trans('forms.location_types.'.$this->value);
    }
}
