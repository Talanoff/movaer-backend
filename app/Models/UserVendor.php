<?php

namespace App\Models;

use App\Enums\UserVendorRoleEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\UserVendor
 *
 * @property UserVendorRoleEnum $role
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Vendor $vendor
 *
 * @method static Builder|UserVendor newModelQuery()
 * @method static Builder|UserVendor newQuery()
 * @method static Builder|UserVendor query()
 *
 * @mixin Eloquent
 */
class UserVendor extends Pivot
{
    protected $fillable = [
        'vendor_id',
        'user_id',
        'role',
        'joined_at',
    ];

    protected $casts = [
        'role' => UserVendorRoleEnum::class,
        'joined_at' => 'datetime',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
