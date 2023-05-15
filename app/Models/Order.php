<?php

namespace App\Models;

use App\Enums\DeliveryCategoryEnum;
use App\Enums\DeliveryLocationTypeEnum;
use App\Enums\OrderStatusEnum;
use Database\Factories\OrderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Talanov\Nanoid\HasNanoId;
use Talanov\Nanoid\NanoIdOptions;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $nano_id
 * @property int|null $vendor_id
 * @property int|null $user_id
 * @property OrderStatusEnum $status
 * @property DeliveryCategoryEnum $category
 * @property int|null $goods_number
 * @property int|null $goods_weight
 * @property string|null $description
 * @property int|null $country_from_id
 * @property int|null $country_to_id
 * @property string $address_from
 * @property string $address_to
 * @property Carbon $pickup_at
 * @property Carbon $delivery_at
 * @property DeliveryLocationTypeEnum $pickup_location_type
 * @property DeliveryLocationTypeEnum $delivery_location_type
 * @property object $details
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, ChatRoom> $chatRooms
 * @property-read int|null $chat_rooms_count
 * @property-read Feedback|null $feedback
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read User|null $user
 * @property-read Vendor|null $vendor
 *
 * @method static OrderFactory factory($count = null, $state = [])
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order onlyTrashed()
 * @method static Builder|Order query()
 * @method static Builder|Order whereAddressFrom($value)
 * @method static Builder|Order whereAddressTo($value)
 * @method static Builder|Order whereCategory($value)
 * @method static Builder|Order whereCountryFromId($value)
 * @method static Builder|Order whereCountryToId($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeletedAt($value)
 * @method static Builder|Order whereDeliveryAt($value)
 * @method static Builder|Order whereDeliveryLocationType($value)
 * @method static Builder|Order whereDescription($value)
 * @method static Builder|Order whereDetails($value)
 * @method static Builder|Order whereGoodsNumber($value)
 * @method static Builder|Order whereGoodsWeight($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereNanoId($value)
 * @method static Builder|Order wherePickupAt($value)
 * @method static Builder|Order wherePickupLocationType($value)
 * @method static Builder|Order whereStatus($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @method static Builder|Order whereVendorId($value)
 * @method static Builder|Order withTrashed()
 * @method static Builder|Order withoutTrashed()
 *
 * @mixin Eloquent
 */
class Order extends Model implements HasMedia
{
    use HasFactory, HasNanoId, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'status',
        'category',
        'goods_number',
        'goods_weight',
        'goods_type',
        'message',
        'address_from',
        'address_to',
        'pickup_at',
        'delivery_at',
        'pickup_location_type',
        'delivery_location_type',
        'details',
        'user_id',
        'vendor_id',
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class,
        'category' => DeliveryCategoryEnum::class,
        'pickup_location_type' => DeliveryLocationTypeEnum::class,
        'delivery_location_type' => DeliveryLocationTypeEnum::class,
        'pickup_at' => 'date',
        'delivery_at' => 'date',
        'details' => 'object',
    ];

    public function getNanoIdOptions(): NanoIdOptions
    {
        return NanoIdOptions::make();
    }

    /* Relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function chatRooms(): HasMany
    {
        return $this->hasMany(ChatRoom::class);
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }

    /* Media */

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->performOnCollections('images')
            ->width(250);
    }
}
