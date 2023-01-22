<?php
declare(strict_types=1);

namespace PandaZoom\LaravelComment\Actions;

use PandaZoom\LaravelComment\Contracts\DeleteCommentActionContract;
use PandaZoom\LaravelComment\Exceptions\CommentNotDeletedException;
use PandaZoom\LaravelComment\Models\Comment;
use function throw_if;

class DeleteCommentAction implements DeleteCommentActionContract
{
    public function run(Comment $comment, bool $permanent = false): ?bool
    {
        $isSuccess = $permanent ? $comment->forceDelete() : $comment->delete();

        throw_if(
            ! $isSuccess,
            CommentNotDeletedException::class
        );

        return $isSuccess;
    }
}
