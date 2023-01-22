<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use PandaZoom\LaravelUser\Models\User;
use function config;
use function fake;
use function now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\PandaZoom\LaravelUser\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string|string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'active' => 1,
            'locale' => fake()->randomElement(config('app.locales')),
            'timezone' => fake()->timezone,
            'password' => '$2y$10$GNYT8CN7heGyvLJIuUkRHOZSLNZpOm0kgFCk8UrLJ7teJ9G22Ir9S', // 00000000 - 8 times 0
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes): array => [
            'email_verified_at' => null,
        ]);
    }

    public function asNotDeleted(): static
    {
        return $this->state(fn(array $attributes): array => [
            'deleted_at' => null,
        ]);
    }

    public function asDeleted(): static
    {
        return $this->state(fn(array $attributes): array => [
            'deleted_at' => now(),
        ]);
    }

    public function asNotActive(): static
    {
        return $this->state(fn(array $attributes): array => [
            'active' => 0,
        ]);
    }
}
