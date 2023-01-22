<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use function base_path;
use function info;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('queue:work --max-jobs=1000 --max-time=3600')
            ->withoutOverlapping()
            ->before(static function (): void {
                info('[queue:work][started]');
            })
            ->after(static function (): void {
                info('[queue:work][stopped]');
            })
            ->onSuccess(static function (): void {
                info('[queue:work][success]');
            })
            ->onFailure(static function (): void {
                info('[queue:work][failure]');
            });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
