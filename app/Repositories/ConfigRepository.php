<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;

class ConfigRepository
{
    public function services(): array
    {
        return Service::has('vehicles')
            ->get(['id', 'name'])
            ->map(fn (Service $service) => [
                'id' => $service->id,
                'name' => $service->name,
            ])
            ->toArray();
    }

    public function vehicles(array $services): array
    {
        return Vehicle::with('service:id,name')
            ->when(count($services), fn (Builder $query) => $query->whereIn('service_id', $services))
            ->get(['name', 'service_id', 'id'])
            ->groupBy('service.name')
            ->map->map(fn (Vehicle $vehicle) => [
                'id' => $vehicle->id,
                'name' => $vehicle->name,
            ])
            ->toArray();
    }

    public function countries(): array
    {
        return Country::visible()
            ->get(['id', 'name', 'alpha2'])
            ->map(fn (Country $country) => [
                'id' => $country->id,
                'name' => $country->name,
                'alpha2' => $country->alpha2,
            ])
            ->toArray();
    }
}
