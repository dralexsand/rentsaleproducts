<?php

namespace App\Console\Commands;

use App\Services\CheckExpiredPeriodService;
use Illuminate\Console\Command;

class CheckExpiredRentCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rent:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check rent period expired every five minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $logs = (new CheckExpiredPeriodService())->checkRentPeriods();
        \Log::info("Expired products: ", $logs);
    }
}
