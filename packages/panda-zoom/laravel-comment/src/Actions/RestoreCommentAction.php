<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Actions;

use PandaZoom\LaravelComment\Contracts\RestoreCommentActionContract;
use PandaZoom\LaravelComment\Exceptions\CommentNotRestoredException;
use PandaZoom\LaravelComment\Models\Comment;
use function throw_if;

class RestoreCommentAction implements RestoreCommentActionContract
{
    /**
     * @inheritDoc
     */
    public function run(Comment $comment): ?bool
    {
        $isSuccess = $comment->restore();

        throw_if(
            ! $isSuccess,
            CommentNotRestoredException::class
        );

        return $isSuccess;
    }
}
