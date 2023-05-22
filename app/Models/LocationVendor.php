<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LocationVendor extends Pivot
{
    protected $fillable = [
        'location_id',
        'vendor_id',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean'
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

        static::saving(static function (Pivot $model) {
            if ($model->is_default) {
                $model->vendor->locations()->update(['is_default' => 0]);
                $model->is_default = true;
            }
        });
    }
}
