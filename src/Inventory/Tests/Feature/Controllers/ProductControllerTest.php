<?php

use ECommerce\Inventory\Domain\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

use function Pest\Laravel\getJson;

uses(TestCase::class);

it('returns paginated response', function () {
    Product::factory(40)->create();

    sanctumLogin();

    getJson('/inventory-module/products?page=2')
        ->assertOk()
        ->assertJson(fn (AssertableJson $json) => $json->has('data', 15)
                ->has('links')
                ->has('meta')
                ->where('meta.per_page', 15)
                ->where('meta.current_page', 2)
                ->where('meta.last_page', 3)
                ->where('meta.from', 16)
                ->where('meta.to', 30)
                ->where('meta.total', 40)
        );
});
