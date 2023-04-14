<?php

namespace App\Models;

use App\Enums\WishCategoryEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

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
