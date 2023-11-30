<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\ProductStatus;
use Exception;

class ProductStatusService implements ServiceGetDataInterface
{

    public function getAll(): array
    {
        try {
            $result['data'] = ProductStatus::query()->get();
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
            $result['data'] = ProductStatus::query()->find($id)->first();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $result;
    }
}
