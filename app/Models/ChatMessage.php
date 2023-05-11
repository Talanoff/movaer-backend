<?php

namespace App\Models;

use App\Enums\ChatMessageOfferStatusEnum;
use App\Enums\ChatMessageTypeEnum;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\ChatMessage
 *
 * @property int $id
 * @property int $chat_room_id
 * @property int $user_id
 * @property ChatMessageTypeEnum $type
 * @property ChatMessageOfferStatusEnum|null $offer_status
 * @property string $body
 * @property Carbon $read_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\ChatRoom $room
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\ChatMessageFactory factory($count = null, $state = [])
 * @method static Builder|ChatMessage newModelQuery()
 * @method static Builder|ChatMessage newQuery()
 * @method static Builder|ChatMessage query()
 * @method static Builder|ChatMessage whereBody($value)
 * @method static Builder|ChatMessage whereChatRoomId($value)
 * @method static Builder|ChatMessage whereCreatedAt($value)
 * @method static Builder|ChatMessage whereId($value)
 * @method static Builder|ChatMessage whereOfferStatus($value)
 * @method static Builder|ChatMessage whereReadAt($value)
 * @method static Builder|ChatMessage whereType($value)
 * @method static Builder|ChatMessage whereUpdatedAt($value)
 * @method static Builder|ChatMessage whereUserId($value)
 *
 * @mixin Eloquent
 */
class ChatMessage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'type',
        'offer_status',
        'body',
        'user_id',
        'chat_room_id',
        'read_at',
    ];

    protected $casts = [
        'type' => ChatMessageTypeEnum::class,
        'offer_status' => ChatMessageOfferStatusEnum::class,
        'read_at' => 'datetime',
    ];

    /* Relationships */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id');
    }
}
