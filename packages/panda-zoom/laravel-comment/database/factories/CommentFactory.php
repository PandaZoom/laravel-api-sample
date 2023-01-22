<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelUser\Models\User;
use function fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\PandaZoom\LaravelComment\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string|string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'message' => fake()->realText(25),
        ];
    }
}
