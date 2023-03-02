<?php

namespace App\Models;

use App\Enums\ChatMessageOfferStatusEnum;
use App\Enums\ChatMessageTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\ChatMessage
 *
 * @property int $id
 * @property int $chat_room_id
 * @property int $user_id
 * @property ChatMessageTypeEnum $type
 * @property ChatMessageOfferStatusEnum|null $offer_status
 * @property string $body
 * @property \Illuminate\Support\Carbon $read_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\ChatRoom $room
 * @property-read \App\Models\User $user
 *
 * @method static \Database\Factories\ChatMessageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereChatRoomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereOfferStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatMessage whereUserId($value)
 *
 * @mixin \Eloquent
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
