<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PandaZoom\LaravelLanguage\Models\Language;
use function collect;
use function count;
use function file_exists;
use function file_get_contents;
use function is_array;
use function json_decode;

class LanguageTableSeeder extends Seeder
{
    public function run(): void
    {
        $this->runByPart();
    }

    protected function runByPart(): void
    {
        if (file_exists(__DIR__ . '/../data/languages.json')) {
            $json = file_get_contents(__DIR__ . '/../data/languages.json');

            $json = json_decode($json);

            if (is_array($json) && !empty($json)) {

                $this->command->info('Seeding languages...');
                $this->command->getOutput()->progressStart(count($json));

                Language::unguard();

                collect($json)->each(function (object $item, int $i): void {
                    $data = [];

                    $this->command->getOutput()->progressAdvance();

                    foreach (collect($item)->keys()->all() as $property) {
                        $data[$property] = $item->{$property};
                    }

                    if (!empty($data)) {
                        Language::query()->updateOrCreate(['id' => $data['id']], $data);
                    }
                });

                Language::reguard();

                $this->command->getOutput()->progressFinish();
            }
        }
    }
}
