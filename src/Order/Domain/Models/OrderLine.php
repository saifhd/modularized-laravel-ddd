<?php

namespace ECommerce\Order\Domain\Models;

use ECommerce\Order\Infrastructure\Database\Factories\OrderLineFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'price'
    ];

    protected static function newFactory()
    {
        return OrderLineFactory::new();
    }

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function subtotal(): float
    {
        return $this->price * $this->quantity;
    }
}
