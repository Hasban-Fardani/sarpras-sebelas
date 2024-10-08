<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OutgoingItem>
 */
class OutgoingItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'OUT-' . $this->faker->unique()->numberBetween(1000, 9999),
            'operator_id' => 1,
            'division_id' => $this->faker->numberBetween(1, 5),
            'note' => $this->faker->sentence(),
        ];
    }
}
