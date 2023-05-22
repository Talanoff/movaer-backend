<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\LocationVendor
 *
 * @property int $location_id
 * @property int $vendor_id
 * @property bool $is_default
 * @property-read \App\Models\Location $location
 * @property-read \App\Models\Vendor $vendor
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LocationVendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationVendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationVendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|LocationVendor whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationVendor whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LocationVendor whereVendorId($value)
 *
 * @mixin \Eloquent
 */
class LocationVendor extends Pivot
{
    protected $fillable = [
        'location_id',
        'vendor_id',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    /* Relationships */

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /* Boot */

    protected static function booted(): void
    {
        parent::booted();

        static::saving(static function (LocationVendor $model) {
            if ($model->is_default) {
                $model->vendor
                    ->locations()
                    ->where('location_id', '!=', $model->location_id)
                    ->update(['is_default' => 0]);
            }
        });
    }
}
