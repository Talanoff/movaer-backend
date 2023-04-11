<?php

namespace App\Enums;

enum DeliveryCategoryEnum: int
{
    case OnePackage = 0;
    case ManyPackages = 1;
    case Pallet = 2;
    case Various = 3;

    public function getIconName(): string
    {
        return match ($this) {
            self::OnePackage => 'package',
            self::ManyPackages => 'trolley',
            self::Pallet => 'pallet',
            self::Various => 'warehouse',
        };
    }

    public function getName(): string
    {
        return match ($this) {
            self::OnePackage => __('Package'),
            self::ManyPackages => __('Many packages'),
            self::Pallet => __('Pallet(s)'),
            self::Various => __('Various goods'),
        };
    }
}
