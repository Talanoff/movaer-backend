<?php

namespace App\Models;

use Database\Factories\ChatRoomFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, ChatMessage> $messages
 * @property-read int|null $messages_count
 * @property-read Order|null $order
 * @property-read User $user
 * @property-read Vendor|null $vendor
 *
 * @method static ChatRoomFactory factory($count = null, $state = [])
 * @method static Builder|ChatRoom newModelQuery()
 * @method static Builder|ChatRoom newQuery()
 * @method static Builder|ChatRoom query()
 * @method static Builder|ChatRoom whereCreatedAt($value)
 * @method static Builder|ChatRoom whereId($value)
 * @method static Builder|ChatRoom whereNanoId($value)
 * @method static Builder|ChatRoom whereOrderId($value)
 * @method static Builder|ChatRoom whereTitle($value)
 * @method static Builder|ChatRoom whereUpdatedAt($value)
 * @method static Builder|ChatRoom whereUserId($value)
 * @method static Builder|ChatRoom whereVendorId($value)
 *
 * @mixin Eloquent
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
