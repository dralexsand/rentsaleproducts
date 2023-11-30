<?php

namespace Database\Seeders;

use App\Models\RentalPeriod;
use App\Traits\SeederDataTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class RentalPeriodSeeder extends Seeder
{
    use SeederDataTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listPeriods = $this->listRentalPeriods();

        RentalPeriod::query()->insert($listPeriods);

        Cache::forever('rental_periods', ['data' => RentalPeriod::query()->get()]);
    }
}
