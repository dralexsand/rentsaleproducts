<?php


namespace App\Traits;

trait SeederDataTrait
{
    public function listStatuses(): array
    {
        return [
            [
                'id' => 1,
                'status' => 'accessible'
            ],
            [
                'id' => 2,
                'status' => 'sold'
            ],
            [
                'id' => 3,
                'status' => 'leased'
            ],
        ];
    }

    public function listRentalPeriods(): array
    {
        return [
            [
                'id' => 1,
                'period' => 4
            ],
            [
                'id' => 2,
                'period' => 8
            ],
            [
                'id' => 3,
                'period' => 12
            ],
            [
                'id' => 4,
                'period' => 24
            ],
        ];
    }
}
