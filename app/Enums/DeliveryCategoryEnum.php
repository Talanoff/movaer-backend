<?php

namespace App\Enums;

enum DeliveryCategoryEnum: int
{
    case OnePackage = 0;
    case ManyPackages = 1;
    case Pallet = 2;
    case Various = 3;

    public function getName(): string
    {
        return match ($this) {
            self::OnePackage => __('Package'),
            self::ManyPackages => __('Many packages'),
            self::Pallet => __('Pallet(s)'),
            self::Various => __('Various goods'),
        };
    }

    public static function fromRequest(string $name): DeliveryCategoryEnum
    {
        return match ($name) {
            'one' => self::OnePackage,
            'many' => self::ManyPackages,
            'pallets' => self::Pallet,
            'various' => self::Various
        };
    }
}
