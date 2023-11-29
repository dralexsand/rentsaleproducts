<?php

declare(strict_types=1);


namespace App\Services;

interface ServiceStoreInterface
{
    public function store(array $data): array;
}
