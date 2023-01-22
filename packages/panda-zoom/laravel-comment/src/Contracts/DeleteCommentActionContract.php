<?php

namespace PandaZoom\LaravelComment\Contracts;

use PandaZoom\LaravelComment\Models\Comment;

interface DeleteCommentActionContract
{
    /**
     * @param Comment $comment
     * @param bool $permanent
     * @return bool|null
     *
     * @throws \Throwable
     */
    public function run(Comment $comment, bool $permanent = false): ?bool;
}
