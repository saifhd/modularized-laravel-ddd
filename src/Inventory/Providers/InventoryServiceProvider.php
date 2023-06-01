<?php

namespace ECommerce\Inventory\Providers;

use ECommerce\Inventory\Contracts\ProductService as ProductServiceContract;
use ECommerce\Inventory\Infrastructure\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class InventoryServiceProvider extends ServiceProvider
{
    public $bindings = [
        ProductServiceContract::class => ProductService::class,
    ];

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Infrastructure/Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadFactoriesFrom(__DIR__.'/../Infrastructure/Database/Factories');

    }

    public function register()
    {

    }
}
