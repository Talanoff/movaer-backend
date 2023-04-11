<?php

namespace App\Models;

use App\Enums\VendorScopeEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Packages\UniqId\HasUniqId;
use Packages\UniqId\UniqIdOptions;
use Talanov\Nanoid\HasNanoId;
use Talanov\Nanoid\NanoIdOptions;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $uid
 * @property string $name
 * @property string|null $about
 * @property string|null $address
 * @property VendorScopeEnum $scope
 * @property string $employees
 * @property float|null $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\ChatRoom> $chatRooms
 * @property-read int|null $chat_rooms_count
 * @property-read Collection<int, \App\Models\Feedback> $feedback
 * @property-read int|null $feedback_count
 * @property-read Collection<int, \App\Models\Service> $options
 * @property-read int|null $options_count
 * @property-read Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property-read Collection<int, \App\Models\Vehicle> $vehicles
 * @property-read int|null $vehicles_count
 *
 * @method static \Database\Factories\VendorFactory factory($count = null, $state = [])
 * @method static Builder|Vendor newModelQuery()
 * @method static Builder|Vendor newQuery()
 * @method static Builder|Vendor query()
 * @method static Builder|Vendor whereAbout($value)
 * @method static Builder|Vendor whereAddress($value)
 * @method static Builder|Vendor whereCreatedAt($value)
 * @method static Builder|Vendor whereEmployees($value)
 * @method static Builder|Vendor whereId($value)
 * @method static Builder|Vendor whereName($value)
 * @method static Builder|Vendor whereRating($value)
 * @method static Builder|Vendor whereScope($value)
 * @method static Builder|Vendor whereUid($value)
 * @method static Builder|Vendor whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class Vendor extends Model
{
    use HasFactory, HasNanoId;

    protected $fillable = [
        'name',
        'about',
        'address',
        'scope',
        'employees',
        'rating',
    ];

    protected $casts = [
        'scope' => VendorScopeEnum::class,
    ];

    public function getNanoIdOptions(): NanoIdOptions
    {
        return NanoIdOptions::make();
    }

    /* Relationships */

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role', 'joined_at')
            ->using(UserVendor::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function chatRooms(): HasMany
    {
        return $this->hasMany(ChatRoom::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class)->withPivot('quantity');
    }

    public function feedback(): HasManyThrough
    {
        return $this->hasManyThrough(Feedback::class, Order::class);
    }
}
