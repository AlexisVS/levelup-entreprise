<?php

namespace App\Console;

use App\Jobs\SendMailDailyUncompletedTasksUsers;
use App\Models\User;
use Carbon\Carbon;
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
        $users = User::all()->skip(1);
        if (Carbon::parse('21:00:00') == Carbon::parse(Carbon::now($tz = '1'))) {
            foreach ($users as $user) {
                $schedule->job(SendMailDailyUncompletedTasksUsers::dispatch($user))->dailyAt('21:00');
            }
        }
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
