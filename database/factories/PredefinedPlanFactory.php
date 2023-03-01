<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PredefinedPlan>
 */
class PredefinedPlanFactory extends Factory
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
            'is_online' => fake()->boolean(),
        ];
    }
}
