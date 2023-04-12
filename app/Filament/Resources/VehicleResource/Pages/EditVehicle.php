<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVehicle extends EditRecord
{
//    use EditRecord\Concerns\Translatable;

    protected static string $resource = VehicleResource::class;

    protected function getActions(): array
    {
        return [
            //            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
