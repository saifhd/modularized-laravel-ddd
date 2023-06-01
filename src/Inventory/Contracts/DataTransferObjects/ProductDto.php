<?php

namespace ECommerce\Inventory\Contracts\DataTransferObjects;

class ProductDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly float $price
    )
    {

    }
}
