<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Seeder;
use PandaZoom\LaravelUser\Models\User;
use function fake;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->count(200)
            ->when(
                fake()->boolean(30),
                fn(Factory $factory)=> $factory->asNotActive(),
            )
            ->when(
                fake()->boolean(30),
                fn(Factory $factory)=> $factory->unverified(),
            )
            ->create();
    }
}
