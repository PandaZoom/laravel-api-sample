<?php
declare(strict_types=1);

namespace PandaZoom\LaravelArticleLog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelArticle\Models\Article;
use Throwable;

class CreateArticleStatusLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 1;

    public function __construct(protected Article $article, protected ?int $statusId)
    {
        //
    }

    public function handle(): void
    {
        try {
            $this->article->articleStatusLogs()->create([
                'status_id' => $this->statusId
            ]);
        } catch (Throwable) {
        }
    }
}
