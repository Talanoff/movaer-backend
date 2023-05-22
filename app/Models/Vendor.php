<?php

namespace App\Models;

use App\Enums\UserVendorRoleEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;
use Talanov\Nanoid\HasNanoId;
use Talanov\Nanoid\NanoIdOptions;

/**
 * App\Models\Vendor
 *
 * @property int $id
 * @property string $nano_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $iban
 * @property string|null $vat
 * @property string|null $commerce_no
 * @property string $post_code
 * @property string $address
 * @property string|null $about
 * @property string|null $employees
 * @property float|null $rating
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\ChatRoom> $chatRooms
 * @property-read int|null $chat_rooms_count
 * @property-read Collection<int, \App\Models\Feedback> $feedback
 * @property-read int|null $feedback_count
 * @property-read Collection<int, \App\Models\Location> $locations
 * @property-read int|null $locations_count
 * @property-read Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read Collection<int, \App\Models\User> $owners
 * @property-read int|null $owners_count
 * @property-read Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
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
 * @method static Builder|Vendor whereCommerceNo($value)
 * @method static Builder|Vendor whereCreatedAt($value)
 * @method static Builder|Vendor whereEmail($value)
 * @method static Builder|Vendor whereEmployees($value)
 * @method static Builder|Vendor whereIban($value)
 * @method static Builder|Vendor whereId($value)
 * @method static Builder|Vendor whereName($value)
 * @method static Builder|Vendor whereNanoId($value)
 * @method static Builder|Vendor wherePhone($value)
 * @method static Builder|Vendor wherePostCode($value)
 * @method static Builder|Vendor whereRating($value)
 * @method static Builder|Vendor whereUpdatedAt($value)
 * @method static Builder|Vendor whereVat($value)
 *
 * @mixin Eloquent
 */
class Vendor extends Model
{
    use HasFactory, HasNanoId;

    protected $fillable = [
        'name',
        'iban',
        'vat',
        'commerce_no',
        'about',
        'employees',
        'rating',
        'email',
        'phone',
        'post_code',
        'street',
        'house_no',
        'address',
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

    public function owners(): BelongsToMany
    {
        return $this->users()->wherePivot('role', UserVendorRoleEnum::Owner);
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
        return $this->belongsToMany(Service::class)->distinct();
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class)
            ->withPivot('quantity', 'service_id')
            ->using(VehicleVendor::class);
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class)
            ->withPivot('is_default')
            ->using(LocationVendor::class);
    }

    public function feedback(): HasManyThrough
    {
        return $this->hasManyThrough(Feedback::class, Order::class);
    }

    /* Accessors & Mutators */

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: static fn ($value): string => "+$value",
            set: static fn ($value) => preg_replace('/\D/', '', $value)
        );
    }
}
