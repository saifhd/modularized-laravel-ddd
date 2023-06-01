<?php

namespace ECommerce\Inventory\Contracts\Exceptions;

use Exception;

class ProductNotFoundException extends Exception
{
    public function __construct(public readonly int $productId)
    {

    }
}
