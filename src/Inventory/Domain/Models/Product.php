<?php

namespace ECommerce\Inventory\Domain\Models;

use ECommerce\Inventory\Infrastructure\Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected static function newFactory()
    {
        return ProductFactory::new();
    }

}
