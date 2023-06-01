<?php

namespace ECommerce\Order\Domain\Models;

use ECommerce\Inventory\Contracts\DataTransferObjects\ProductDto;
use ECommerce\Order\Domain\Exceptions\EmptyOrderException;
use ECommerce\Order\Infrastructure\Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'tax',
        'total_amount'
    ];

    protected static function newFactory()
    {
        return OrderFactory::new();
    }

    public function orderLines() : HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function addOrderLine(ProductDto $product, int $quantity): void
    {
        $orderLine = new OrderLine([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
        ]);

        $this->orderLines[] = $orderLine;
    }

    public function checkout(): void
    {
        if (empty($this->orderLines)) {
            throw new EmptyOrderException();
        }

        $this->amount = collect($this->orderLines)->sum(fn (OrderLine $orderLine) => $orderLine->subtotal()
        );
        $this->tax = $this->amount * TaxRate::current()->rate;
        $this->total_amount = $this->amount + $this->tax;

        $this->save();
        $this->orderLines()->saveMany($this->orderLines);
        $this->refresh();
    }
}
