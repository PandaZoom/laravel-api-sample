<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelCategory\Models\Category;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelUser\Models\User;
use function auth;
use function fake;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->inRandomOrder()->first();

        auth()->setUser($user);

        Article::factory()
            ->count(50)
            ->has(Comment::factory()->count(30))
            ->create()
            ->each(static function (Article $article): void {

                $article->user()->associate(User::query()->inRandomOrder()->first()->id);

                $article->status()->associate(Status::query()->inRandomOrder()->first());

                $article->categories()->attach(Category::query()->active()->inRandomOrder()->first());

                $article->translations()->createMany([
                    [
                        'locale' => 'en',
                        'title' => 'EN title '. fake()->text(25),
                        'name' => 'EN name '. fake()->text(30),
                    ],
                    [
                        'locale' => 'de',
                        'title' => 'DE title '. fake()->text(25),
                        'name' => 'DE name '. fake()->text(30),
                    ],
                    [
                        'locale' => 'fr',
                        'title' => 'FR title '. fake()->text(25),
                        'name' => 'FR name '. fake()->text(30),
                    ]
                ]);
            });
    }
}
