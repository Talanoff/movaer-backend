<?php

namespace App\Models;

use App\Enums\UserVendorRoleEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserVendor
 *
 * @property int $vendor_id
 * @property int $user_id
 * @property UserVendorRoleEnum $role
 * @property Carbon $joined_at
 * @property-read User $user
 * @property-read Vendor $vendor
 *
 * @method static Builder|UserVendor newModelQuery()
 * @method static Builder|UserVendor newQuery()
 * @method static Builder|UserVendor query()
 * @method static Builder|UserVendor whereJoinedAt($value)
 * @method static Builder|UserVendor whereRole($value)
 * @method static Builder|UserVendor whereUserId($value)
 * @method static Builder|UserVendor whereVendorId($value)
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
