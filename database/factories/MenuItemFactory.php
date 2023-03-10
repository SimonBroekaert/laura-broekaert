<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Simonbroekaert\LinkPicker\LinkPicker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => fake()->word(),
            'link' => LinkPicker::fake(),
            'is_online' => fake()->boolean(80),
            'opens_in_new_tab' => fake()->boolean(10),
        ];
    }
}
