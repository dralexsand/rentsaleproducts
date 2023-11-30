<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductStatusResource;
use App\Services\ProductStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $response = Cache::get('product_statuses');

        if ($response === null) {
            $response = $this->productStatusService->getAll();
        }

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

}
