<?php

namespace App\Services;

use App\Data\UserData;
use App\Data\VendorData;
use App\Data\VendorLocationData;
use App\Enums\UserVendorRoleEnum;
use App\Models\Location;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Contracts\DataCollectable;

class VendorService
{
    private User $user;

    private Vendor $vendor;

    public function __construct(
        private readonly UserService $userService
    ) {
        //
    }

    public function register(VendorData $attributes): Model|Vendor
    {
        $vendor = Vendor::create($attributes->toArray());

        $this->user->vendors()->sync([
            $vendor->getKey() => [
                'role' => UserVendorRoleEnum::Owner,
                'joined_at' => now(),
            ],
        ]);

        return $vendor;
    }

    public function assignLocations(DataCollectable $locations): void
    {
        $items = [];

        foreach ($locations as $location) {
            $item = Location::firstOrCreate([
                'country_id' => $location->country,
                'name' => $location->location,
            ]);

            $items[$item->getKey()] = ['is_default' => $location->default];
        }

        $this->vendor->locations()->sync($items);
    }

    public function assignVehicles(array $vehicles): void
    {
        $items = [];

        foreach ($vehicles as $list) {
            foreach ($list as $vehicle) {
                $items[$vehicle['key']] = [
                    'quantity' => (int) $vehicle['value'],
                ];
            }
        }

        $this->vendor->vehicles()->sync($items);
    }

    public function store(Collection $data): Model|Vendor
    {
        $this->user = $this->userService->register(UserData::from($data));
        $this->vendor = $this->register(VendorData::from($data));

        $this->assignVehicles($data->get('vehicles', []));
        $this->assignLocations(VendorLocationData::collection($data->get('locations')));

        return $this->vendor;
    }
}
