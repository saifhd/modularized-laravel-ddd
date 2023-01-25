<?php

namespace ECommerce\Inventory\Application\Http\Controllers;

use App\Http\Controllers\Controller;
use ECommerce\Inventory\Application\Http\Requests\StoreProductRequest;
use ECommerce\Inventory\Application\Http\Requests\UpdateProductRequest;
use ECommerce\Inventory\Application\Http\Resources\ProductResource;
use ECommerce\Inventory\Domain\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {

    }

    public function store(StoreProductRequest $request)
    {

    }

    public function update(UpdateProductRequest $request, Product $product)
    {

    }

    public function delete(Product $product)
    {

    }
}
