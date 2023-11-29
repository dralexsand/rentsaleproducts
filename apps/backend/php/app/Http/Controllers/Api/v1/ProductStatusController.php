<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStatusResource;
use App\Services\ProductStatusService;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    public function __construct(protected ProductStatusService $productStatusService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->productStatusService->getAll();

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : ProductStatusResource::collection($response['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->productStatusService->getById($id);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new ProductStatusResource($response['data']);
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
