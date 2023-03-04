<?php

namespace Database\Factories;

use App\Enums\PlanStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount_of_persons' => fake()->numberBetween(1, 10),
            'amount_of_sessions' => fake()->numberBetween(1, 10),
            'status' => fake()->randomElement(PlanStatus::cases()),
            'price' => fake()->numberBetween(100, 1000),
            'discount_percentage' => fake()->numberBetween(0, 100),
            'tax_percentage' => fake()->numberBetween(0, 100),
            'external_location' => fake()->address(),
        ];
    }
}
