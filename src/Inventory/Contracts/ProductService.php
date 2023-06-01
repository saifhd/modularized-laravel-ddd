<?php

namespace ECommerce\Inventory\Contracts;

use ECommerce\Inventory\Contracts\DataTransferObjects\ProductDto;

interface ProductService
{
    public function decrementStock(int $productId, int $quantity): void;

    public function getProductById(int $productId): ProductDto;
}
