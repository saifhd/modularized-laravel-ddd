<?php

namespace ECommerce\Inventory\Infrastructure\Services;

use ECommerce\Inventory\Contracts\DataTransferObjects\ProductDto;
use ECommerce\Inventory\Contracts\Exceptions\ProductInactiveException;
use ECommerce\Inventory\Contracts\Exceptions\ProductNotFoundException;
use ECommerce\Inventory\Contracts\Exceptions\ProductOutOfStockException;
use ECommerce\Inventory\Contracts\ProductService as ProductServiceContract;
use ECommerce\Inventory\Domain\Models\Product;

class ProductService implements ProductServiceContract
{
    public function decrementStock(int $productId, int $quantity) : void
    {
        $product = Product::find($productId);


        if (!$product) {
            throw new ProductNotFoundException($productId);
        }

        if ($product->stock < $quantity) {
            throw new ProductOutOfStockException($productId);
        }

        if (!$product->is_active) {
            throw new ProductInactiveException($productId);
        }

        $product->decrement('stock', $quantity);
    }

    public function getProductById(int $productId) : ProductDto
    {
        $product = Product::find($productId);

        if (! $product) {
            throw new ProductNotFoundException($productId);
        }

        return new ProductDto(
            $product->id,
            $product->name,
            $product->price,
        );
    }
}
