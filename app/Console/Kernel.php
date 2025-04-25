<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MqttListener;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        MqttListener::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Jadwal otomatis (opsional)
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
