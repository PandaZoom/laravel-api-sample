<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PandaZoom\LaravelCategory\Models\Category;
use function fake;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()
            ->count(25)
            ->create()
            ->each(static function (Category $category): void {
                $category->translations()->createMany([
                    [
                        'locale' => 'en',
                        'name' => 'EN name ' . fake()->text(20),
                    ],

                    [
                        'locale' => 'de',
                        'name' => 'DE name ' . fake()->text(20),
                    ],
                    [
                        'locale' => 'fr',
                        'name' => 'FR name ' . fake()->text(20),
                    ]
                ]);
            });
    }
}
