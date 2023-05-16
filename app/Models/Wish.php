<?php

namespace App\Models;

use App\Enums\WishCategoryEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Wish
 *
 * @property int $id
 * @property array $name
 * @property WishCategoryEnum $category
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Wish newModelQuery()
 * @method static Builder|Wish newQuery()
 * @method static Builder|Wish query()
 * @method static Builder|Wish whereCategory($value)
 * @method static Builder|Wish whereCreatedAt($value)
 * @method static Builder|Wish whereId($value)
 * @method static Builder|Wish whereName($value)
 * @method static Builder|Wish whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Wish extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'category',
    ];

    protected $translatable = [
        'name',
    ];

    protected $casts = [
        'category' => WishCategoryEnum::class,
    ];

    /* Scopes */

    public function scopeCommon(Builder $builder): void
    {
        $builder->where('category', WishCategoryEnum::Common);
    }

    public function scopeAdditional(Builder $builder): void
    {
        $builder->where('category', WishCategoryEnum::Additional);
    }
}
