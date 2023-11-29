<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RentalPeriodResource;
use App\Services\RentalPeriodService;
use Illuminate\Http\Request;

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
        $response = $this->rentalPeriodService->getAll();

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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
