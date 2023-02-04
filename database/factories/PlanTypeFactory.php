<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PlanType>
 */
class PlanTypeFactory extends Factory
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
            'amount_of_persons' => fake()->numberBetween(1, 3),
            'is_online' => fake()->boolean(),
        ];
    }

    /**
     * Indicate that the plan type is online.
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
