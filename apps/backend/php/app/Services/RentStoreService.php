<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\Product;
use App\Models\ProductRented;
use App\Models\RentUser;
use Exception;


class RentStoreService implements ServiceStoreInterface
{

    public function store(array $data): array
    {
        $product = Product::query()
            ->where('id', (int)$data['product_id'])
            ->where(['status_id' => 1])
            ->first();

        if (!$product) {
            return [
                'status' => 400,
                'error' => 'Product unavailable',
            ];
        }

        try {
            $rentedStartDate = date('Y-m-d H:i:s');

            $rent = new RentUser();
            $rent->user_id = auth()->id();
            $rent->product_id = (int)$data['product_id'];
            $rent->rented_start = $rentedStartDate;
            $rent->period_id = (int)$data['period_id'];
            $rent->save();

            $product->update(['status_id' => 3]);

            ProductRented::query()->insert([
                'product_code' => $rent->product->code,
                'rented_end' => (new ProductRented())->getRentedEndDate($rentedStartDate, (int)$data['period_id']),
            ]);

            $result['data'] = $rent;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return $result;
    }

}
