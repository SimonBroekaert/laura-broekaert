<?php

namespace Database\Factories;

use App\Enums\ClientStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->dateTimeBetween('-100 years', '-18 years'),
            'status' => fake()->randomElement(ClientStatus::cases()),
        ];
    }
}
