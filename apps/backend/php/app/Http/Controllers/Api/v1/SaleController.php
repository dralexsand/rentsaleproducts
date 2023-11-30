<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentPostRequest;
use App\Http\Requests\SalePostRequest;
use App\Http\Resources\SaleUserResource;
use App\Services\SaleGetDataService;
use App\Services\SaleStoreService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct(
        protected SaleGetDataService $getDataService,
        protected SaleStoreService $storeService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->getDataService->getAll();

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : SaleUserResource::collection($response['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->getDataService->getById($id);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new SaleUserResource($response['data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalePostRequest $request)
    {
        $data = $request->all();

        $response = $this->storeService->store($data);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new SaleUserResource($response['data']);
    }

}
