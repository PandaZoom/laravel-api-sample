<?php
declare(strict_types=1);

namespace PandaZoom\LaravelCommentLog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelComment\Models\Comment;
use Throwable;

class CreateCommentMessageLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 1;

    public function __construct(protected Comment $comment, protected ?string $message)
    {
        //
    }

    public function handle(): void
    {
        try {
            $this->comment->commentMessageLogs()->create([
                'message' => $this->message,
            ]);
        } catch (Throwable) {
        }
    }
}
