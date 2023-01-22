<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelArticle\Models\Article;
use PandaZoom\LaravelArticleLog\Models\ArticleViewLog;
use PandaZoom\LaravelUser\Models\User;
use Throwable;
use function now;
use function request;

class StoreArticleViewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 1;

    public function __construct(protected Article $article)
    {
        //
    }

    public function handle(): ?ArticleViewLog
    {
        try {
            $output = null;
            if ($this->isDoesntExist()) {
                $output = $this->article->articleViewLogs()->create([]);
            }

            return $output;
        } catch (Throwable) {
        }
    }

    protected function isDoesntExist(): bool
    {
        $instance = ArticleViewLog::query();

        $isStop = true;

        if (request()?->user() instanceof User) {
            $instance->where('user_id', request()?->user()->getAuthIdentifier());
            $isStop = false;
        }

        if (!empty(request()?->ip())) {
            $instance->where('ip_address', request()?->ip());
            $isStop = false;
        }

        $doesntExist = false;

        if (!$isStop) {
            $doesntExist = $instance->where('created_at', '>=', now()->subMinutes(15))
                ->doesntExist();
        }

        return $doesntExist;
    }
}
