<?php

namespace App\Schedules;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\AboutCommand;

class PlanMaturitySchedule
{
    public function __invoke(Schedule $schedule)
    {
        $schedule->command('plans:process-maturities')
            ->daily()
            ->description('Process matured investment plans')
            ->onOneServer(); // Optional: for production environments
    }
}