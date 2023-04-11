<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Talanov\Nanoid\HasNanoId;
use Talanov\Nanoid\NanoIdOptions;

/**
 * App\Models\ChatRoom
 *
 * @property int $id
 * @property string $nano_id
 * @property string $title
 * @property int|null $order_id
 * @property int|null $vendor_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ChatMessage> $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\Order|null $order
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Vendor|null $vendor
 *
 * @method static \Database\Factories\ChatRoomFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereNanoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatRoom whereVendorId($value)
 *
 * @mixin \Eloquent
 */
class ChatRoom extends Model
{
    use HasFactory, HasNanoId;

    protected $fillable = [
        'uid',
        'title',
        'user_id',
        'vendor_id',
        'order_id',
    ];

    public function getNanoIdOptions(): NanoIdOptions
    {
        return NanoIdOptions::make()->length(12);
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

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }
}
