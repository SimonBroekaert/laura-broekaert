<?php

namespace Database\Factories;

use App\Enums\StatisticType;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = fake()->randomElement(StatisticType::cases());

        return [
            'client_id' => Client::factory(),
            'type' => $type,
            'value' => match ($type) {
                StatisticType::TYPE_WEIGHT => fake()->randomFloat(2, 40, 120),
                StatisticType::TYPE_HEIGHT => fake()->randomFloat(2, 1.40, 2.20),
                default => fake()->randomFloat(),
            },
        ];
    }
}
