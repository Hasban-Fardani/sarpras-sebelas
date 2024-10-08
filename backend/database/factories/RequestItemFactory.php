<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestItem>
 */
class RequestItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'RI' . $this->faker->unique()->numberBetween(1000, 9999),
            'employee_id' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['diajukan', 'disetujui', 'ditolak', 'draf']),
            'regarding' => $this->faker->sentence(),
            'characteristic' => $this->faker->randomElement(['biasa', 'penting', 'sangat penting']),
            'note' => $this->faker->sentence(),
        ];
    }
}
