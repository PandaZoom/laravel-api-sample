<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticle\Events;

use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelArticle\Contracts\ArticleEventContract;

class ArticleShown implements ArticleEventContract
{
    use SerializesModels;

    public function __construct(public Article $article)
    {
        //
    }
}
