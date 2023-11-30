<?php

declare(strict_types=1);


namespace App\Services;

interface ServiceGetDataInterface
{
    public function getAll(): array;

    public function getById(string $id): array;

}
