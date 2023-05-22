<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\VehicleVendor
 *
 * @property int $vendor_id
 * @property int $vehicle_id
 * @property int $service_id
 * @property int|null $quantity
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor whereVehicleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleVendor whereVendorId($value)
 *
 * @mixin \Eloquent
 */
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
