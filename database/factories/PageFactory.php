<?php

namespace Database\Factories;

use App\Nova\Flexible\Presets\DefaultPreset;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->unique()->word();

        return [
            'developer_id' => fake()->unique()->word(),
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => DefaultPreset::fake(),
            'is_online' => fake()->boolean(),
        ];
    }

    /**
     * Indicate that the page is online.
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
