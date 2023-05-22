<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property array $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\Vehicle> $vehicles
 * @property-read int|null $vehicles_count
 * @property-read Collection<int, \App\Models\Vendor> $vendors
 * @property-read int|null $vendors_count
 *
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Service extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
    ];

    protected $translatable = [
        'name',
    ];

    /* Relationships */

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class)
            ->using(VehicleVendor::class);
    }
}
