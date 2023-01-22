<?php

namespace PandaZoom\LaravelArticle\Contracts;

use PandaZoom\LaravelArticle\Models\Article;

interface ShowArticleActionContract
{
    public function run(Article $article): void;
}
