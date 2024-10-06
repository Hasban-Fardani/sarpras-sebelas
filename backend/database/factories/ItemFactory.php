<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'I-' . $this->faker->unique()->numberBetween(1000, 9999),
            'name' => $this->faker->word(),
            'unit' => $this->faker->word(),
            'merk' => $this->faker->word(),
            'type' => $this->faker->word(),
            'size' => $this->faker->word(),
            'price' => $this->faker->numberBetween(1000, 10000),
            'stock' => $this->faker->numberBetween(0, 100),
            'min_stock' => $this->faker->numberBetween(0, 100),
            'category_id' => 1,
            'image' => $this->faker->image('public/storage/images', 480, 480, null, false),
        ];
    }
}
