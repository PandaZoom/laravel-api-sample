<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Actions;

use Illuminate\Support\Collection;
use PandaZoom\LaravelBase\Exceptions\EmptyIncomeDataException;
use PandaZoom\LaravelComment\Contracts\UpdateCommentActionContract;
use PandaZoom\LaravelComment\Exceptions\CommentNotUpdatedException;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelBase\Services\RelationByRequest;
use function app;
use function throw_if;

class UpdateCommentAction implements UpdateCommentActionContract
{
    public function run(Comment $comment, Collection $attributes): bool
    {
        throw_if(
            $attributes->isEmpty(),
            EmptyIncomeDataException::class
        );

        $isSuccess = $comment->update($attributes->only([
            'message',
        ])->toArray());

        throw_if(
            ! $isSuccess,
            CommentNotUpdatedException::class
        );

        $with = app(RelationByRequest::class)
            ->addSupportedWith(['user'])
            ->filterWith();

        if(!empty($with)){
            $comment->load($with);
        }

        return $isSuccess;
    }
}
