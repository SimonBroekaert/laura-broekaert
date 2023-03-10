<?php

namespace Database\Factories;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()
                ->name(),
            'email' => fake()
                ->unique()
                ->safeEmail(),
            'password' => Hash::make(config('fake.admin-password')),
            'type' => fake()
                ->randomElement(UserType::cases()),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's type is admin.
     *
     * @return static
     */
    public function admin(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => UserType::TYPE_ADMIN,
        ]);
    }

    /**
     * Indicate that the model's type is developer.
     *
     * @return static
     */
    public function developer(): self
    {
        return $this->state(fn (array $attributes) => [
            'type' => UserType::TYPE_DEVELOPER,
        ]);
    }
}
