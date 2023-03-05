<?php

namespace Database\Factories;

use App\Enums\SessionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'datetime' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'status' => fake()->randomElement(SessionStatus::cases()),
        ];
    }
}
