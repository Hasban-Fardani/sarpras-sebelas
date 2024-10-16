<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestItem>
 */
class RequestItemDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'qty' => $this->faker->numberBetween(1, 100),
            'qty_acc' => $this->faker->numberBetween(1, 100),
            'item_id' => $this->faker->numberBetween(1, 5),
            'request_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
