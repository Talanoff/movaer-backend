<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int $order_id
 * @property int $service_rating
 * @property int $delivery_rating
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Vendor|null $vendor
 *
 * @method static \Database\Factories\FeedbackFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereDeliveryRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereServiceRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Feedback whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_rating',
        'delivery_rating',
        'message',
        'order_id',
    ];

    /* Relationships */

    public function vendor(): HasOneThrough
    {
        return $this->hasOneThrough(Vendor::class, Order::class, 'id', 'id', 'id', 'vendor_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
