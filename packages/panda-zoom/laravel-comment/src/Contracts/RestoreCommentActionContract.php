<?php

namespace PandaZoom\LaravelComment\Contracts;

use PandaZoom\LaravelComment\Models\Comment;

interface RestoreCommentActionContract
{
    /**
     * @param  Comment  $comment
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(Comment $comment): ?bool;
}
