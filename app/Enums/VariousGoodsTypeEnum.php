<?php

namespace App\Enums;

enum VariousGoodsTypeEnum: int
{
    case Cars = 0;
    case Furniture = 1;
    case SeaContainer = 2;
    case RollContainer = 3;
    case FlowerContainer = 4;
    case DanishFlowerContainer = 5;
    case Bikes = 6;
    case Liquids = 7;
    case ConstructionMaterials = 8;
    case Cattle = 9;
    case HangingMeat = 10;
    case Bulk = 11;
    case SomethingDifferent = 12;

    public static function toResource(): array
    {
        return array_map(static fn($it) => [
            'key' => $it->value,
            'value' => trans('forms.various_goods.' . $it->value),
        ], self::cases());
    }
}
