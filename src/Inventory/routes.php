<?php

use ECommerce\Inventory\Application\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('inventory-module')
    ->middleware(['api', 'auth:sanctum'])
    ->group(function () {
        Route::apiResource('products', ProductController::class);
    });
