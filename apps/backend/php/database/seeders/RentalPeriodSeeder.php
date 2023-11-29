<?php

namespace Database\Seeders;

use App\Models\RentalPeriod;
use App\Traits\SeederDataTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
