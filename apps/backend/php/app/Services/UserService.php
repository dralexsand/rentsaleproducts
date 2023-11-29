<?php

declare(strict_types=1);


namespace App\Services;

use App\Models\User;
use Exception;

class UserService implements ServiceGetDataInterface
{

    public function getAll(): array
    {
        try {
            $result['data'] = User::query()->get();
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
            $result['data'] = User::query()->find($id)->first();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $result;
    }
}
