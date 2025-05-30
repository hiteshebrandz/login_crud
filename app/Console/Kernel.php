<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DecreaseQuantity;
use Illuminate\Support\Facades\DB;
use App\Models\Product; // make sure this matches your model

class Kernel extends ConsoleKernel
{
    protected $commands = [
        DecreaseQuantity::class,
    ];

protected function schedule(Schedule $schedule): void
{
    $schedule->call(function () {
        Product::where('quantity', '>', 0)->each(function ($product) {
            $product->decrement('quantity');
        });
    })->everyMinute();
}


    // protected function schedule(Schedule $schedule): void
    // {
    //     $schedule->command('quantity:decrease')->everyMinute();
    // }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
