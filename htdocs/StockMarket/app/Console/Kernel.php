<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Schedule\Services\ScheduleService;
use Modules\Stock\Services\StockService;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // php artisan schedule:work
        // 推薦購買排程
        // $schedule->call(function () {
        //     $service = app()->make(StockMarketService::class);
        //     $service->recommendBuy();
        // })->hourly()->between('9:00', '13:30')->weekdays(); // 請替換為您希望的時間

        // 關注價格
        $schedule->call(function () {
            $service = app()->make(ScheduleService::class);
            $service->ownBuy();
        })->everyFiveMinutes()->between('9:00', '13:30')->weekdays(); // 請替換為您希望的時間
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
