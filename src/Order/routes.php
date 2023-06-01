<?php

use ECommerce\Order\Application\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('order-module')
    // ->middleware(['api', 'auth:sanctum'])
    ->group(function () {
        Route::apiResource('orders', OrderController::class);
    });
