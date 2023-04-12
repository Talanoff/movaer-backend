<?php

namespace App\Models;

use Database\Factories\VehicleFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property int $service_id
 * @property array $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Service $service
 * @property-read Collection<int, Vendor> $vendors
 * @property-read int|null $vendors_count
 *
 * @method static VehicleFactory factory($count = null, $state = [])
 * @method static Builder|Vehicle newModelQuery()
 * @method static Builder|Vehicle newQuery()
 * @method static Builder|Vehicle query()
 * @method static Builder|Vehicle whereCreatedAt($value)
 * @method static Builder|Vehicle whereId($value)
 * @method static Builder|Vehicle whereName($value)
 * @method static Builder|Vehicle whereServiceId($value)
 * @method static Builder|Vehicle whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Vehicle extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name',
        'service_id',
    ];

    protected $translatable = [
        'name',
    ];

    /* Relationships */

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class)->withPivot('quantity');
    }
}
