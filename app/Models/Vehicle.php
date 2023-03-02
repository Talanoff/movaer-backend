<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Vehicle
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vendor> $vendors
 * @property-read int|null $vendors_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vehicle whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /* Relationships */

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class)->withPivot('quantity');
    }
}
