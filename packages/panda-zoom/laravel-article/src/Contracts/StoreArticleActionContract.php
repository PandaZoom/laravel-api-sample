<?php

namespace PandaZoom\LaravelArticle\Contracts;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Models\Article;

interface StoreArticleActionContract
{
    public function run(Collection $attributes): Article;
}
