<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\RentalPeriod;
use Exception;

class RentalPeriodService implements ServiceGetDataInterface
{
    public function getAll(): array
    {
        try {
            $result['data'] = RentalPeriod::query()->get();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $result;
    }

    public function getById(string $id): array
    {
        try {
            $result['data'] = RentalPeriod::query()->find($id)->first();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $result;
    }
}
