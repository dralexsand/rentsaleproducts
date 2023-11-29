<?php

namespace Database\Seeders;

use App\Models\ProductStatus;
use App\Traits\SeederDataTrait;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    use SeederDataTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listStatuses = $this->listStatuses();

        ProductStatus::query()->insert($listStatuses);
    }
}
