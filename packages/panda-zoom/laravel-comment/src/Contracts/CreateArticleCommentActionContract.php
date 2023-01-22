<?php

namespace PandaZoom\LaravelComment\Contracts;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelComment\Models\Comment;

interface CreateArticleCommentActionContract
{
    public function run(Article $article, Collection $attributes): Comment;
}
