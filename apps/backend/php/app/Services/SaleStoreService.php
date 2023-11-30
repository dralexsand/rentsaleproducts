<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\Product;
use App\Models\SaleUser;
use Exception;


class SaleStoreService implements ServiceStoreInterface
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
            $sale = new SaleUser();
            $sale->user_id = auth()->id();
            $sale->product_id = (int)$data['product_id'];
            $sale->sales_date = date('Y-m-d H:i:s');
            $sale->save();

            $product->update(['status_id' => 2]);

            $result['data'] = $sale;
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return $result;
    }


}
