<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubmissionItem>
 */
class SubmissionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'SI' . $this->faker->unique()->numberBetween(1000, 9999),
            'division_id' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['diajukan', 'disetujui', 'ditolak', 'draf']),
            'operator_id' => 3,
            'supervisor_id' => 1,
            'regarding' => $this->faker->sentence(),
            'note' => $this->faker->sentence(),
            'submission_session_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
