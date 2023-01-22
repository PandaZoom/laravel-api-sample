<?php
declare(strict_types=1);

namespace PandaZoom\LaravelUserLog\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PandaZoom\LaravelUser\Models\User;
use Throwable;

class CreateUserFirstNameLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 1;

    public function __construct(protected User $user, protected ?string $firstName)
    {
        //
    }

    public function handle(): void
    {
        try {
            $this->user->userFirstNameLogs()->create([
                'first_name' => $this->firstName,
            ]);
        } catch (Throwable) {
        }
    }
}
