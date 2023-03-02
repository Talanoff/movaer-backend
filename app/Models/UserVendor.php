<?php

namespace App\Models;

use App\Enums\UserVendorRoleEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\UserVendor
 *
 * @property int $vendor_id
 * @property int $user_id
 * @property UserVendorRoleEnum $role
 * @property \Illuminate\Support\Carbon $joined_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Vendor $vendor
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor whereJoinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVendor whereVendorId($value)
 *
 * @mixin \Eloquent
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
