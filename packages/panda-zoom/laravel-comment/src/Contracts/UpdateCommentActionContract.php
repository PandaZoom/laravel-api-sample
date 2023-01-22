<?php

namespace PandaZoom\LaravelComment\Contracts;

use Illuminate\Support\Collection;
use PandaZoom\LaravelComment\Models\Comment;

interface UpdateCommentActionContract
{
    /**
     * @param Comment $comment
     * @param \Illuminate\Support\Collection $attributes
     * @return bool
     *
     * @throws \Throwable
     */
    public function run(Comment $comment, Collection $attributes): bool;
}
