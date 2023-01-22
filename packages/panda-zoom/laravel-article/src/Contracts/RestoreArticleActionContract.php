<?php

namespace PandaZoom\LaravelArticle\Contracts;

use PandaZoom\LaravelArticle\Models\Article;

interface RestoreArticleActionContract
{
    /**
     * @param  Article  $article
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(Article $article): ?bool;
}
