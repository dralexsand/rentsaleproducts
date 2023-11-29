<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentPostRequest;
use App\Http\Resources\RentUserResource;
use App\Services\RentGetDataService;
use App\Services\RentStoreService;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function __construct(
        protected RentGetDataService $getDataService,
        protected RentStoreService $storeService
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
            : RentUserResource::collection($response['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->getDataService->getById($id);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new RentUserResource($response['data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RentPostRequest $request)
    {
        $data = $request->all();

        $response = $this->storeService->store($data);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new RentUserResource($response['data']);
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
