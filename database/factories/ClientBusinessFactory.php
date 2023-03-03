<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClientBusiness>
 */
class ClientBusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'tax_number' => fake()->unique()->randomNumber(8),
            'street' => fake()->streetName(),
            'street_number' => fake()->buildingNumber(),
            'city' => fake()->city(),
            'postal_code' => fake()->postcode(),
        ];
    }
}
