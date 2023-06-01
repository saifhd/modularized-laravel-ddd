<?php

namespace ECommerce\Order\Domain\Models;

use ECommerce\Order\Infrastructure\Database\Factories\TaxRateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return TaxRateFactory::new();
    }

    public static function current(): self
    {
        $now = now();

        $rate = self::where('start_at', '<=', $now)
            ->where('end_at', '>=', $now)
            ->first();

        if (! $rate) {
            // throw new TaxRateNotFoundException();
        }

        return $rate;
    }
}
