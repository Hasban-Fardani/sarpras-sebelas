<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IncomingItem>
 */
class IncomingItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'INV-' . $this->faker->unique()->numberBetween(1000, 9999),
            'operator_id' => 3,
            'supplier_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
