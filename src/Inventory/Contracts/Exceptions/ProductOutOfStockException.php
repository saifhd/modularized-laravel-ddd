<?php

namespace ECommerce\Inventory\Contracts\Exceptions;

use Exception;

class ProductOutOfStockException extends Exception
{
    public function __construct(public readonly int $productId)
    {

    }
}
