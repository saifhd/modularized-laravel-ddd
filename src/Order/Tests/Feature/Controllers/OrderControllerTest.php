<?php

use App\Models\User;
use ECommerce\Inventory\Contracts\DataTransferObjects\ProductDto;
use ECommerce\Inventory\Contracts\ProductService;
use ECommerce\Order\Contracts\Events\OrderFulfilled;
use ECommerce\Order\Domain\Models\Cart;
use ECommerce\Order\Domain\Models\TaxRate;
use ECommerce\Payment\Contracts\PaymentService;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

use function Pest\Laravel\mock;
use function Pest\Laravel\postJson;

uses(TestCase::class);

it('creates a new order', function () {
    Event::fake();
    TaxRate::factory()->create();
    $user = User::factory()->create();
    $cart = Cart::factory()->create([
        'user_id' => $user->id
    ]);

    $products = collect([
        new ProductDto(1, 'Product 1', 100),
        new ProductDto(2, 'Product 2',200)
    ]);

    $cart->cartItems()->createMany(
        $products->map(fn (ProductDto $product) => [
            'product_id' => $product->id,
            'quantity' => 1
        ])
    );

    mock(ProductService::class, function ($mock) use ($products) {
        $products->each(function (ProductDto $product) use ($mock) {
            $mock->shouldReceive('decrementStock')
                ->with($product->id, 1)
                ->once();

            $mock->shouldReceive('getProductById')
                ->with($product->id)
                ->once()
                ->andReturn($product);
        });
    });

    mock(PaymentService::class, function ($mock) {
        $mock->shouldReceive('charge')
            ->once();
    });

    sanctumLogin($user);

    $order = postJson('/order-module/orders', ['cart_id' => $cart->id])
        ->assertCreated()
        ->json('data');

    Event::assertDispatched(OrderFulfilled::class, $order['id']);
});
