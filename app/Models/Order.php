<?php

namespace App\Models;

use Database\Factories\OrderFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $order_number
 * @property string $status
 * @property string $total_amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static OrderFactory factory($count = null, $state = [])
 * @method static Builder<static>|Order filterStatus($status)
 * @method static Builder<static>|Order newModelQuery()
 * @method static Builder<static>|Order newQuery()
 * @method static Builder<static>|Order query()
 * @method static Builder<static>|Order whereCreatedAt($value)
 * @method static Builder<static>|Order whereId($value)
 * @method static Builder<static>|Order whereOrderNumber($value)
 * @method static Builder<static>|Order whereStatus($value)
 * @method static Builder<static>|Order whereTotalAmount($value)
 * @method static Builder<static>|Order whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'status',
        'total_amount',
    ];

    const PENDING = 'pending';
    const SHIPPED = 'shipped';
    const DELIVERED = 'delivered';
    const CANCELED = 'canceled';


    const STATUSES = [
        self::PENDING,
        self::SHIPPED,
        self::DELIVERED,
        self::CANCELED,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
