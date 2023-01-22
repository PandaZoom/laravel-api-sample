<?php

namespace PandaZoom\LaravelComment\Events;

use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelComment\Models\Comment;
use PandaZoom\LaravelComment\Contracts\CommentEventContract;

class CommentSaved implements CommentEventContract
{
    use SerializesModels;

    public function __construct(public Comment $comment)
    {
        //
    }
}
