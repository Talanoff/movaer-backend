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
            $items[] = Location::updateOrCreate($location->toArray())->getKey();
        }

        $vendor->locations()->sync($items);
    }

    public function assignVehicles(Vendor $vendor, array $vehicles): void
    {
        $attachment = collect($vehicles)->values()
            ->mapWithKeys(fn ($value) => $value)
            ->mapWithKeys(fn ($value) => [$value['key'] => ['quantity' => (int) $value['value']]]);

        $vendor->services()->sync(array_keys($vehicles));
        $vendor->vehicles()->sync($attachment);
    }
}
