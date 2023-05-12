<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class VehicleVendor extends Pivot
{
    protected $fillable = [
        'vendor_id',
        'vehicle_id',
        'service_id',
        'quantity',
    ];

    public static function booted(): void
    {
        parent::booted();

        self::saving(static function (Model|VehicleVendor $model) {
            $model->service_id = Vehicle::find($model->vehicle_id)->service_id;
        });
    }
}
