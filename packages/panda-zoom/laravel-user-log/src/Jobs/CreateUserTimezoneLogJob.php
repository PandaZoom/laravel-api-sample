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

class CreateUserTimezoneLogJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $tries = 1;

    public function __construct(protected User $user, protected string $timezone)
    {
        //
    }

    public function handle(): void
    {
        try {
            $this->user->userTimezoneLogs()->create([
                'timezone' => $this->timezone,
            ]);
        } catch (Throwable) {
        }
    }
}
