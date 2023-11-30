<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->productService->getAll();

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : ProductResource::collection($response['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->productService->getById($id);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new ProductResource($response['data']);
    }

}
