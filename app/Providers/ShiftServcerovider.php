<?php

namespace App\Providers;
use App\Entity\Shift;
use Illuminate\Support\ServiceProvider;


class ShiftServcerovider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(Shift::class, function ($app,$params) {
            $shiftName = $params['shiftName'];
            $shiftStart = $params['shiftStart'];
            $shiftEnd = $params['shiftEnd'];

            return new Shift($shiftName, $shiftStart, $shiftEnd);
        });
    }
}

?>
