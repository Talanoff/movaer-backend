<?php

namespace App\Repositories;

use App\Enums\DeliveryLocationTypeEnum;
use App\Map\KeyValue;
use App\Models\Country;
use App\Models\Service;
use App\Models\Vehicle;
use App\Models\Wish;
use Illuminate\Database\Eloquent\Builder;

class ConfigRepository
{
    public function services(): array
    {
        return Service::has('vehicles')
            ->get(['id', 'name'])
            ->mapInto(KeyValue::class)
            ->toArray();
    }

    public function vehicles(array $services): array
    {
        return Vehicle::with('service:id,name')
            ->when(count($services), fn (Builder $query) => $query->whereIn('service_id', $services))
            ->get(['name', 'service_id', 'id'])
            ->groupBy('service.id')
            ->map->mapInto(KeyValue::class)
            ->toArray();
    }

    public function countries(): array
    {
        return Country::visible()
            ->get(['id', 'name'])
            ->mapInto(KeyValue::class)
            ->toArray();
    }

    public function wishes(): array
    {
        return Wish::get(['id', 'name', 'category'])
            ->groupBy(fn ($category) => $category->category->value)
            ->map->mapInto(KeyValue::class)
            ->toArray();
    }

    public function locationTypes(): array
    {
        return DeliveryLocationTypeEnum::toResource();
    }
}
