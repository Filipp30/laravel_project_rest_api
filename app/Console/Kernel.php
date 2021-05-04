<?php

namespace App\Console;
use App\Console\Commands\sendLogFileToAdmin;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{

    protected $commands = [

    ];

    protected function schedule(Schedule $schedule)
    {
         $schedule->command(sendLogFileToAdmin::class)->everySixHours();

    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
