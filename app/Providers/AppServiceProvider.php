<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
            Route::middleware('api')->group(base_path('routes/api.php'));

            Carbon::setLocale('id');
            date_default_timezone_set('Asia/Jakarta');
    }
}
