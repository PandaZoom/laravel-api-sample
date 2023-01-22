<?php
declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelUser\Models\User;
use function fake;
use function now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\PandaZoom\LaravelArticle\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string|string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = now();
        return [
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'status_id' => Status::query()->inRandomOrder()->first()->id,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
