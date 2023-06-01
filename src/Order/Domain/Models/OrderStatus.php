<?php

namespace ECommerce\Order\Domain\Models;

use ECommerce\Order\Infrastructure\Database\Factories\OrderStatusFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return OrderStatusFactory::new();
    }
}
