<?php

namespace ECommerce\Order\Infrastructure\Database\Factories;

use ECommerce\Order\Domain\Models\TaxRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaxRate>
 */
class TaxRateFactory extends Factory
{
    protected $model = TaxRate::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'rate' => 0.08,
            'start_at' => now()->subYears(3),
            'end_at' => now()->addYears(2),
        ];
    }
}
