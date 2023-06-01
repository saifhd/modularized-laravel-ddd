<?php

use ECommerce\Inventory\Contracts\DataTransferObjects\ProductDto;
use ECommerce\Inventory\Contracts\Exceptions\ProductInactiveException;
use ECommerce\Inventory\Contracts\Exceptions\ProductNotFoundException;
use ECommerce\Inventory\Contracts\Exceptions\ProductOutOfStockException;
use ECommerce\Inventory\Domain\Models\Product;
use ECommerce\Inventory\Infrastructure\Services\ProductService;
use Tests\TestCase;

uses(TestCase::class);

beforeEach(function () {
    $this->productService = new ProductService();
});


it('should decrement stock by quantity', function () {
    $product = Product::factory()->create([
        'stock' => 5,
        'is_active' => true
    ]);

    $this->productService->decrementStock($product->id, 1);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 4
    ]);
});

it('should throw exceptions while decrement stock', function (int $id, $exception) {
    expect(fn () => $this->productService->decrementStock($id, 1))
        ->toThrow($exception);

})->with([
    [fn() => 1, ProductNotFoundException::class],
    [fn() => Product::factory()->create(['stock' => 0])->id, ProductOutOfStockException::class],
    [fn() => Product::factory()->create(['is_active' => 0])->id, ProductInactiveException::class]
]);

it('should find product by id', function () {
    $product = Product::factory()->create();

    $data = $this->productService->getProductById($product->id);
    expect($data)
        ->toBeInstanceOf(ProductDto::class)
        ->toEqual(new ProductDto($product->id, $product->name, $product->price));
});

it('should throw product not found exception if product details not found', function () {
    $this->productService->getProductById(1);
})->throws(ProductNotFoundException::class);

