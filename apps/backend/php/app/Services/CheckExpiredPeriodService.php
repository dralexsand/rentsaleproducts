<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\Product;
use App\Models\ProductRented;

class CheckExpiredPeriodService
{
    public function checkRentPeriods(): array
    {
        $expiredRented = ProductRented::query()
            ->where('rented_end', '<', date('Y-m-d H:i:00'))
            ->get();

        $logs = [];

        if (sizeof($expiredRented) === 0) {
            return $logs;
        }

        foreach ($expiredRented as $item) {
            $product = Product::query()
                ->where('code', '=', $item->product_code)
                ->first();

            $logs[] = "Product with code: {$item->code} is expired";

            $product->status_id = 1;

            ProductRented::query()
                ->where('product_code', '=', $item->product_code)
                ->delete();
        };

        return $logs;
    }
}
