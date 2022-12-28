<?php

namespace App\Console;

use App\Jobs\FetchLogs;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            FetchLogs::fetch(); 
        })->everyMinute()->name('logs')->withoutOverlapping();
    }

    protected function shortSchedule(\Spatie\ShortSchedule\ShortSchedule $shortSchedule)
    {
        // this artisan command will run every second, its signature will be resolved from container
        $shortSchedule->command('schedule:run')->everySecond(1)->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}