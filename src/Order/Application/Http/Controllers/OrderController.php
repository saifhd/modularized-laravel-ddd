<?php

namespace ECommerce\Order\Application\Http\Controllers;

use App\Http\Controllers\Controller;
use ECommerce\Inventory\Contracts\ProductService;
use ECommerce\Order\Application\Http\Requests\OrderStoreRequest;
use ECommerce\Order\Application\Http\Resources\OrderResource;
use ECommerce\Order\Contracts\Events\OrderFulfilled;
use ECommerce\Order\Domain\Models\Cart;
use ECommerce\Order\Domain\Models\CartItem;
use ECommerce\Order\Domain\Models\Order;
use ECommerce\Payment\Contracts\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private PaymentService $paymentService)
    {

    }

    public function index()
    {
        return 123;
    }

    public function store(OrderStoreRequest $request)
    {
        $cart = Cart::with('cartItems')->findOrFail($request->cart_id);
        $order = new Order([
            'user_id' => auth()->user()->id
        ]);

        DB::transaction(function () use ($cart, $order) {
            $cart->cartItems->each(function (CartItem $cartItem) use ($order) {
                $this->productService->decrementStock($cartItem->product_id, $cartItem->quantity);
                $product = $this->productService->getProductById($cartItem->product_id);

                $order->addOrderLine($product, $cartItem->quantity);

                // charge payment goes here
            });

            $order->checkout();
            $this->paymentService->charge($order->id, $order->total_amount);
        });

        OrderFulfilled::dispatch($order->id);
        // return order goes here

        return OrderResource::make($order);
    }
}
