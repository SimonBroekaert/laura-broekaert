<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'method' => fake()->randomElement(PaymentMethod::cases()),
            'status' => fake()->randomElement(PaymentStatus::cases()),
            'price' => fake()->numberBetween(100, 1000),
            'discount_percentage' => fake()->numberBetween(0, 100),
            'tax_percentage' => fake()->numberBetween(0, 100),
        ];
    }
}
