<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PandaZoom\LaravelCategory\Models\Category;
use function fake;
use function now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\PandaZoom\LaravelCategory\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string|string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = now();
        return [
            'active' => fake()->boolean(80),
            'position' => fake()->randomDigitNotZero(),
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
