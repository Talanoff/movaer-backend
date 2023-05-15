<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Str;

/**
 * App\Models\Location
 *
 * @property int $id
 * @property int $country_id
 * @property array $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Country $country
 *
 * @method static Builder|Location newModelQuery()
 * @method static Builder|Location newQuery()
 * @method static Builder|Location query()
 * @method static Builder|Location whereCountryId($value)
 * @method static Builder|Location whereCreatedAt($value)
 * @method static Builder|Location whereId($value)
 * @method static Builder|Location whereName($value)
 * @method static Builder|Location whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Location extends Model
{
    protected $fillable = [
        'name',
        'country_id',
    ];

    /* Relationships */

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->visible();
    }

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class);
    }

    protected function name(): Attribute
    {
        return Attribute::set(static fn ($value) => Str::title($value));
    }
}