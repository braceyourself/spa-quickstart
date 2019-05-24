<?php

namespace App\Console;

use App\EndpointCallSchedule;
use App\Jobs\CallApiEndpoint;
use App\Jobs\PullCornerstoneTransactions;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $tasks_run = 0;


        Log::info('Running Scheduled Tasks');
        foreach (EndpointCallSchedule::all() as $task) {
            if($task->endpoint !== null && $task->endpoint->enabled)
                $tasks_run++;
                $schedule->job(

                    new CallApiEndpoint($task->endpoint)

                )->cron($task->cron);
        }
        Log::info("Tasks Run: $tasks_run");

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
