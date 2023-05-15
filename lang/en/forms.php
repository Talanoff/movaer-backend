<?php

use App\Enums\DeliveryLocationTypeEnum;
use App\Enums\UserRoleEnum;
use App\Enums\WishCategoryEnum;

return [
    'fields' => [
        'title' => 'Title (:LOCALE)',
        'name' => 'Name (:LOCALE)',
        'content' => 'Content (:LOCALE)',
        'simple_name' => 'Name',
        'visible' => 'Visible',
        'quantity' => 'Quantity',
        'vehicle' => 'Vehicle',
        'is_default' => 'Use as default',
        'role' => 'Role',
    ],

    'wishes' => [
        WishCategoryEnum::Additional->value => 'Additional',
        WishCategoryEnum::Common->value => 'Common',
    ],

    'location_types' => [
        DeliveryLocationTypeEnum::LivingPlace->value => 'Living place',
        DeliveryLocationTypeEnum::OfficeBuilding->value => 'Office building',
        DeliveryLocationTypeEnum::StorageShed->value => 'Storage shed',
    ],

    'users' => [
        'roles' => [
            UserRoleEnum::Administrator->value => 'Administrator',
            UserRoleEnum::Customer->value => 'Customer',
        ],
    ],
];
