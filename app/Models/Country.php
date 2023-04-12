<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

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
}
