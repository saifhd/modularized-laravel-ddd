<?php

declare(strict_types=1);

namespace ECommerce\Payment\Infrastructure\Services;

use ECommerce\Payment\Contracts\PaymentService as PaymentServiceContract;

class StripePaymentService implements PaymentServiceContract
{
    public function charge(int $orderId, float $amount): void
    {

    }
}
