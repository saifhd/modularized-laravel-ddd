<?php

namespace ECommerce\Order\Domain\Models;

use ECommerce\Order\Infrastructure\Database\Factories\OrderHistoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return OrderHistoryFactory::new();
    }
}
