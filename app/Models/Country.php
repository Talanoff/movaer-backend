<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property array $name
 * @property string $alpha2
 * @property string $alpha3
 * @property int $is_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country visible()
 * @method static Builder|Country whereAlpha2($value)
 * @method static Builder|Country whereAlpha3($value)
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereIsVisible($value)
 * @method static Builder|Country whereName($value)
 * @method static Builder|Country whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Country extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'alpha2',
        'alpha3',
        'is_visible',
    ];

    protected $translatable = [
        'name',
    ];

    /* Scopes */

    public function scopeVisible(Builder $builder): void
    {
        $builder->where('is_visible', 1);
    }
}
