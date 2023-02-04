<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
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
            'street' => fake()->streetName(),
            'street_number' => fake()->buildingNumber(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
        ];
    }
}
