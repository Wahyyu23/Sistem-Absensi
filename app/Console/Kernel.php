<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MqttListener;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        App\Console\Commands\MqttListener::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:attendance-auto-check')->weekdays()->at('16:50');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
