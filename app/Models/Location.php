<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
