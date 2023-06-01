<?php

declare(strict_types=1);

namespace ECommerce\Shipping\Domain\Listeners;

use ECommerce\Order\Contracts\Events\OrderFulfilled;
use Illuminate\Support\Facades\Log;

class NotifyWareHouse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Laracon\Order\Contracts\Events\OrderFulfilled  $event
     * @return void
     */
    public function handle(OrderFulfilled $event)
    {
        Log::info('NotifyWarehouse: '.$event->orderId);

        // notify warehouse system
    }
}
