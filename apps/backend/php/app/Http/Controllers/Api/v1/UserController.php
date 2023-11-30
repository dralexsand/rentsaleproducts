<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->userService->getAll();

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : UserResource::collection($response['data']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = $this->userService->getById($id);

        return isset($response['error'])
            ? response($response['error'], $response['status'])
            : new UserResource($response['data']);
    }

}
