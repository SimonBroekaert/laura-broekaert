<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = fake()->unique()->word();

        return [
            'developer_id' => fake()->unique()->word(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->text(100),
            'amount_of_sessions' => fake()->numberBetween(1, 50),
            'base_price' => fake()->numberBetween(100, 1000),
            'is_online' => fake()->boolean(),
        ];
    }

    /**
     * Indicate that the plan is online.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function online()
    {
        return $this->state(function () {
            return [
                'is_online' => true,
            ];
        });
    }
}
