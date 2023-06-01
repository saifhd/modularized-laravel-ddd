<?php

namespace ECommerce\Order\Domain\Models;

use ECommerce\Order\Infrastructure\Database\Factories\CartItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity'
    ];

    protected static function newFactory()
    {
        return CartItemFactory::new();
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
