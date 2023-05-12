<?php

namespace App\Services;

use App\Data\VendorData;
use App\Enums\UserVendorRoleEnum;
use App\Models\Location;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Contracts\DataCollectable;

class VendorService
{
    public function register(VendorData $attributes, User $user): Model|Vendor
    {
        $vendor = Vendor::create($attributes->toArray());

        $user->vendors()->sync([
            $vendor->getKey() => [
                'role' => UserVendorRoleEnum::Owner,
                'joined_at' => now(),
            ],
        ]);

        return $vendor;
    }

    public function assignLocations(Vendor $vendor, DataCollectable $locations): void
    {
        $items = [];

        foreach ($locations as $location) {
            $item = Location::firstOrCreate([
                'country_id' => $location->country,
                'name' => $location->location,
            ]);

            $items[$item->getKey()] = ['is_default' => $location->default];
        }

        $vendor->locations()->sync($items);
    }

    public function assignVehicles(Vendor $vendor, array $vehicles): void
    {
        $items = [];

        foreach ($vehicles as $list) {
            foreach ($list as $vehicle) {
                $items[$vehicle['key']] = [
                    'quantity' => (int) $vehicle['value'],
                ];
            }
        }

        $vendor->vehicles()->sync($items);
    }
}
