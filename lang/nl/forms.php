<?php

use App\Enums\DeliveryCategoryEnum;
use App\Enums\DeliveryLocationTypeEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\UserRoleEnum;
use App\Enums\VariousGoodsTypeEnum;
use App\Enums\WishCategoryEnum;

return [
    'fields' => [
        'title' => 'Titel (:LOCALE)',
        'name' => 'Naam (:LOCALE)',
        'content' => 'Inhoud (:LOCALE)',
        'simple_name' => 'Naam',
        'phone' => 'Telefoonnummer',
        'locale' => 'Taal',
        'visible' => 'Zichtbaar',
        'quantity' => 'Hoeveelheid',
        'vehicle' => 'Voertuig',
        'is_default' => 'Gebruik als standaard',
        'role' => 'Rol',
        'weight' => 'Gewicht',
        'goods_type' => 'Goederensoort',
        'pickup_details' => 'Ophaalgegevens',
        'delivery_details' => 'Verzendgegevens',
        'registered' => 'Geregistreerd',
        'vendor' => 'Leverancier',
        'customer' => 'Klant',
        'pickup_country' => 'Ophaal land',
        'delivery_country' => 'Land van levering',
        'pickup_address' => 'Ophaaladres',
        'delivery_address' => 'Bezorgadres',
        'pickup_date' => 'Ophaaldatum',
        'delivery_date' => 'Bezorgdatum',
        'pickup_location' => 'Ophaalplaats',
        'delivery_location' => 'Afleveradres',
        'delivery' => 'Levering',
        'wishes' => 'Wensen',
        'common_wishes' => 'Gemeenschappelijke wensen',
        'additional_wishes' => 'Aanvullende wensen',
        'additional_wishes_notes' => 'Notities',
        'order_no' => 'Bestel №',
        'attachments' => 'Bijlagen',
        'checked' => 'Gecontroleerd',
        'country' => 'Land',
    ],

    'locales' => [
        'en' => 'English',
        'nl' => 'Dutch',
    ],

    'wishes' => [
        WishCategoryEnum::Additional->value => 'Aanvullend',
        WishCategoryEnum::Common->value => 'Gewoon',
    ],

    'location_types' => [
        DeliveryLocationTypeEnum::ResidentialBuilding->value => 'Woonhuis',
        DeliveryLocationTypeEnum::OfficeBuilding->value => 'Flatgebouw',
        DeliveryLocationTypeEnum::ApartmentBuilding->value => 'Distributiecentrum',
        DeliveryLocationTypeEnum::DistributionCenter->value => 'Kantoorgebouw',
        DeliveryLocationTypeEnum::CompanyShed->value => 'Bedrijfsloods',
        DeliveryLocationTypeEnum::HealthcareFacility->value => 'Zorginstelling',
        DeliveryLocationTypeEnum::RecreationArea->value => 'Recreatieterrein',
        DeliveryLocationTypeEnum::GuardedArea->value => 'Bewaakt Terrein',
        DeliveryLocationTypeEnum::HarborArea->value => 'Haventerrein',
        DeliveryLocationTypeEnum::Airport->value => 'Vliegveld',
        DeliveryLocationTypeEnum::SomethingDifferent->value => 'Anders',
    ],

    'various_goods' => [
        VariousGoodsTypeEnum::Cars->value => 'Auto(s)',
        VariousGoodsTypeEnum::Furniture->value => 'Meubel(s)',
        VariousGoodsTypeEnum::SeaContainer->value => 'Zeecontainer',
        VariousGoodsTypeEnum::RollContainer->value => 'Rolcontainer',
        VariousGoodsTypeEnum::FlowerContainer->value => 'FH Bloemenkar',
        VariousGoodsTypeEnum::DanishFlowerContainer->value => 'Deense Bloemenkar',
        VariousGoodsTypeEnum::Bikes->value => 'Fiets(en)',
        VariousGoodsTypeEnum::Liquids->value => 'Vloeistof(fen)',
        VariousGoodsTypeEnum::ConstructionMaterials->value => 'Bouwmaterialen',
        VariousGoodsTypeEnum::Cattle->value => 'Vee',
        VariousGoodsTypeEnum::HangingMeat->value => 'Hangend Vlees',
        VariousGoodsTypeEnum::Bulk->value => 'Bulk',
        VariousGoodsTypeEnum::SomethingDifferent->value => 'Anders',
    ],

    'users' => [
        'roles' => [
            UserRoleEnum::Administrator->value => 'Beheerder',
            UserRoleEnum::Customer->value => 'Klant',
        ],
    ],

    'orders' => [
        'categories' => [
            DeliveryCategoryEnum::OnePackage->value => 'Enkel pakket',
            DeliveryCategoryEnum::ManyPackages->value => 'Veel pakketten',
            DeliveryCategoryEnum::Pallet->value => 'Pallet(s)',
            DeliveryCategoryEnum::Various->value => 'Diverse goederen',
        ],
        'statuses' => [
            OrderStatusEnum::Created->value => 'Nieuw',
            OrderStatusEnum::AwaitingForApprove->value => 'In afwachting van goedkeuring',
            OrderStatusEnum::Approved->value => 'Goedgekeurd',
            OrderStatusEnum::Processing->value => 'Verwerken',
            OrderStatusEnum::Fulfilled->value => 'Vervuld',
            OrderStatusEnum::Canceled->value => 'Geannuleerd',
        ],
    ],
];
