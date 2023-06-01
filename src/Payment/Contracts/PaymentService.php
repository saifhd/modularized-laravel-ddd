<?php

namespace ECommerce\Payment\Contracts;

interface PaymentService
{
    public function charge(int $orderId, float $amount) : void;
}
