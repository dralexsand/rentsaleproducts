<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $limit = 100;
        $i = 1;

        while ($i < $limit) {
            $price = rand(10000, 100000);
            $rentalPricePerHour = (int)round(($price / 1000));

            $data = [
                'title' => $faker->company(),
                'price' => $price,
                'rental_cost_per_hour' => $rentalPricePerHour,
                'code' => Str::uuid()
            ];

            Product::query()->insert($data);

            $i++;
        }
    }
}
