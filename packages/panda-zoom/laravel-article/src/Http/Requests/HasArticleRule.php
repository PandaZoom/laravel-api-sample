<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Http\Requests;

use Illuminate\Validation\Rule;
use PandaZoom\LaravelCategory\Models\Category;

trait HasArticleRule
{
    protected function getRules(): array
    {
        return [
            'status_id' => [
                'integer',
            ],
            'published_at' => [
                'date'
            ],
            'expires_at' => [
                'date'
            ],
            'translations' => [
                'array',
                'min:1',
            ],
            'category_id.*' => [
                'integer',
                Rule::exists(Category::class, 'id')->where('active', 1),
            ],
        ];
    }
}
