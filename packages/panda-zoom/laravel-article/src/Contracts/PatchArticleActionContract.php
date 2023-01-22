<?php

namespace PandaZoom\LaravelArticle\Contracts;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Models\Article;

interface PatchArticleActionContract
{
    /**
     * @param Article $article
     * @param \Illuminate\Support\Collection $attributes
     * @return bool
     *
     * @throws \Throwable
     */
    public function run(Article $article, Collection $attributes): bool;
}
