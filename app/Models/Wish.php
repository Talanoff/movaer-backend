<?php

namespace App\Models;

use App\Enums\WishCategoryEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Wish
 *
 * @property int $id
 * @property array $name
 * @property WishCategoryEnum $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Wish newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wish newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wish query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wish whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wish whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wish whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wish whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wish whereUpdatedAt($value)
 *
 * @mixin \Eloquent
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
}
