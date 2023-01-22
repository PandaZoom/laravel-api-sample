<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            PassportSeeder::class,
            LanguageTableSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            StatusSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
