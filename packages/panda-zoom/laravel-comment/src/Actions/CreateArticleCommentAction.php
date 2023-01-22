<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use PandaZoom\LaravelComment\Contracts\CreateArticleCommentActionContract;
use PandaZoom\LaravelComment\Exceptions\CommentNotCreatedException;
use PandaZoom\LaravelComment\Models\Comment;
use function throw_if;

class CreateArticleCommentAction implements CreateArticleCommentActionContract
{
    public function run(Article $article, Collection $attributes): Comment
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        $comment = $article->comments()->create($attributes->only([
            'message',
        ])->toArray());

        throw_if(
            ! ($comment instanceof Comment),
            CommentNotCreatedException::class
        );

        $with = app(RelationByRequest::class)
            ->addSupportedWith(['user'])
            ->filterWith();

        if(!empty($with)){
            $comment->load($with);
        }

        return $comment;
    }
}
