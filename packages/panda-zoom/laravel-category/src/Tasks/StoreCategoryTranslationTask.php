<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCategory\Tasks;

use Illuminate\Database\Eloquent\Collection;
use PandaZoom\LaravelCategory\Models\Category;

class StoreCategoryTranslationTask
{
    public function run(Category $category, array $translation = []): Collection
    {
        if (!$category->wasRecentlyCreated) {
            $category->translations()->delete();
        }

        return $category->translations()->createMany($translation);
    }
}
