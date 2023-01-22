<?php

namespace PandaZoom\LaravelArticle\Contracts;

use PandaZoom\LaravelArticle\Models\Article;

interface DeleteArticleActionContract
{
    /**
     * @param  Article  $article
     * @param  bool $permanent
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(Article $article, bool $permanent = false): ?bool;
}
