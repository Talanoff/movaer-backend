<?php

namespace App\Repositories;

use App\Data\VendorData;
use App\Data\VendorLocationData;
use App\Enums\UserVendorRoleEnum;
use App\Models\Location;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Contracts\DataCollectable;

final class VendorRepository
{
    private ?User $user = null;

    private Vendor $vendor;

    public function __construct(
        private readonly UserRepository $userRepository
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

    public function store(FormRequest $request): void
    {
        if (! $this->user = $request->user('sanctum')) {
            $this->userRepository->fill($request->validated())->store();
            $this->user = $this->userRepository->getUser();
        }

        $this->vendor = $this->register(VendorData::from($request->validated()));

        $this->assignVehicles($request->get('vehicles', []));
        $this->assignLocations(VendorLocationData::collection($request->get('locations')));
    }

    public function getVendor(): Vendor
    {
        return $this->vendor;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
