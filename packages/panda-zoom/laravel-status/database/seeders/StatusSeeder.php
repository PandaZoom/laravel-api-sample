<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PandaZoom\LaravelStatus\Models\Status;
use PandaZoom\LaravelUser\Models\User;
use function array_map;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->inRandomOrder()->first();

        $data = array_map(static function (array $item) use ($user): array {
            $item['user_id'] = $user->getKey();
            return $item;
        }, $this->getData());

        Status::query()->upsert($data, ['id', 'slug']);
    }

    protected function getData(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'draft',
            ],
            [
                'id' => 2,
                'slug' => 'published',
            ],
            [
                'id' => 3,
                'slug' => 'suspend',
            ],
            [
                'id' => 4,
                'slug' => 'archived',
            ],
        ];
    }
}
