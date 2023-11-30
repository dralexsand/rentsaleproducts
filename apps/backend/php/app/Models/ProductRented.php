<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRented extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'product_code',
            'code'
        );
    }

    public function getRentedEndDate(string $rentedStart, int $rentalPeriodId): string
    {
        $hours = ProductRented::query()
            ->find($rentalPeriodId)
            ->first();

        $h = $hours->period;


        return date('Y-m-d H:i:s', strtotime($rentedStart." + $hours hours"));
    }

    public function getRentedCostByRentalPeriodId(int $productId, int $rentalPeriodId): int
    {
        $rentedCost = Product::query()
            ->find($productId)
            ->first()
            ->rental_cost_per_hour;

        $hours = ProductRented::query()
            ->where(['id' => $rentalPeriodId])
            ->first()
            ->period;

        return (int)$rentedCost * (int)$hours;
    }
}
