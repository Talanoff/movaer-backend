<?php

use App\Enums\DeliveryCategoryEnum;
use App\Enums\DeliveryLocationTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\UserRoleEnum;
use App\Enums\WishCategoryEnum;

return [
    'fields' => [
        'title' => 'Title (:LOCALE)',
        'name' => 'Name (:LOCALE)',
        'content' => 'Content (:LOCALE)',
        'simple_name' => 'Name',
        'phone' => 'Phone number',
        'locale' => 'Language',
        'visible' => 'Visible',
        'quantity' => 'Quantity',
        'vehicle' => 'Vehicle',
        'is_default' => 'Use as default',
        'role' => 'Role',
        'weight' => 'Weight',
        'goods_type' => 'Goods type',
        'pickup_details' => 'Pickup details',
        'delivery_details' => 'Delivery details',
        'registered' => 'Registered',
        'vendor' => 'Vendor',
        'customer' => 'Customer',
        'pickup_country' => 'Pickup country',
        'delivery_country' => 'Delivery country',
        'pickup_address' => 'Pickup address',
        'delivery_address' => 'Delivery address',
        'pickup_date' => 'Pickup date',
        'delivery_date' => 'Delivery date',
        'pickup_location' => 'Pickup location',
        'delivery_location' => 'Delivery location',
        'delivery' => 'Delivery',
        'wishes' => 'Wishes',
        'common_wishes' => 'Common wishes',
        'additional_wishes' => 'Additional wishes',
        'additional_wishes_notes' => 'Notes',
        'order_no' => 'Order №',
        'attachments' => 'Attachments',
        'checked' => 'Checked',
        'country' => 'Country'
    ],

    'locales' => [
        'en' => 'English',
        'nl' => 'Dutch',
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

    'orders' => [
        'categories' => [
            DeliveryCategoryEnum::OnePackage->value => 'Single package',
            DeliveryCategoryEnum::ManyPackages->value => 'Many packages',
            DeliveryCategoryEnum::Pallet->value => 'Pallet(s)',
            DeliveryCategoryEnum::Various->value => 'Various goods',
        ],
        'statuses' => [
            OrderStatusEnum::Created->value => 'New',
            OrderStatusEnum::AwaitingForApprove->value => 'Awaiting for approve',
            OrderStatusEnum::Approved->value => 'Approved',
            OrderStatusEnum::Processing->value => 'Processing',
            OrderStatusEnum::Fulfilled->value => 'Fulfilled',
            OrderStatusEnum::Canceled->value => 'Canceled',
        ],
    ],
];
