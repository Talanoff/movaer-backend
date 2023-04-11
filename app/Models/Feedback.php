<?php

namespace App\Models;

use Database\Factories\FeedbackFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Carbon;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property int $order_id
 * @property int $service_rating
 * @property int $delivery_rating
 * @property string|null $message
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @property-read Vendor|null $vendor
 *
 * @method static FeedbackFactory factory($count = null, $state = [])
 * @method static Builder|Feedback newModelQuery()
 * @method static Builder|Feedback newQuery()
 * @method static Builder|Feedback query()
 * @method static Builder|Feedback whereCreatedAt($value)
 * @method static Builder|Feedback whereDeliveryRating($value)
 * @method static Builder|Feedback whereId($value)
 * @method static Builder|Feedback whereMessage($value)
 * @method static Builder|Feedback whereOrderId($value)
 * @method static Builder|Feedback whereServiceRating($value)
 * @method static Builder|Feedback whereUpdatedAt($value)
 *
 * @mixin Eloquent
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
