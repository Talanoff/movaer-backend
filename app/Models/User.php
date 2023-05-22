<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use Eloquent;
use Filament\Models\Contracts\FilamentUser;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Talanov\Nanoid\HasNanoId;
use Talanov\Nanoid\NanoIdOptions;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $nano_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property UserRoleEnum $role
 * @property string $timezone
 * @property string $locale
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\ChatRoom> $chatRooms
 * @property-read int|null $chat_rooms_count
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read Collection<int, \App\Models\Vendor> $vendors
 * @property-read int|null $vendors_count
 *
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLocale($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNanoId($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereTimezone($value)
 * @method static Builder|User whereUpdatedAt($value)
 *
 * @mixin Eloquent
 */
class User extends Authenticatable implements HasMedia, FilamentUser
{
    use HasApiTokens, HasFactory, HasNanoId, Notifiable, InteractsWithMedia;

    protected $fillable = [
        'uid',
        'name',
        'email',
        'phone',
        'password',
        'role',
        'timezone',
        'locale',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => UserRoleEnum::class,
    ];

    public function getNanoIdOptions(): NanoIdOptions
    {
        return NanoIdOptions::make();
    }

    /* Relationships */

    public function vendors(): BelongsToMany
    {
        return $this->belongsToMany(Vendor::class)
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

    /* Admin access */

    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@webcap.com');
    }

    /* Media */

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('avatar')
            ->fit(Manipulations::FIT_CROP, 120, 120);
    }

    /* Accessors & Mutators */

    protected function password(): Attribute
    {
        return Attribute::make(
            set: static fn ($value) => Hash::make($value)
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: static fn ($value): string => "+$value",
            set: static fn ($value) => preg_replace('/\D/', '', $value)
        );
    }
}
