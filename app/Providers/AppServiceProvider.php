<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Console\Commands\ProcessPlanMaturities;
use App\Schedules\PlanMaturitySchedule;
use Illuminate\Console\Scheduling\Schedule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->callAfterResolving(Schedule::class, function (Schedule $schedule) {
            (new PlanMaturitySchedule())($schedule);
        });
        
        // Optional: Display schedule info in About command
        // AboutCommand::add('Investment Plans', [
        //     'Maturity Processor' => fn () => 'Runs daily at midnight',
        // ]);
    }
}
