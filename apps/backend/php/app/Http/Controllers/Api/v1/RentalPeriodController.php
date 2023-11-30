<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RentalPeriodResource;
use App\Services\RentalPeriodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RentalPeriodController extends Controller
{
    public function __construct(protected RentalPeriodService $rentalPeriodService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Cache::get('rental_periods');

        if ($response === null) {
            $response = $this->rentalPeriodService->getAll();
        }

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : RentalPeriodResource::collection($response['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->rentalPeriodService->getById($id);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new RentalPeriodResource($response['data']);
    }
}
