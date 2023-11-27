<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::name('api.')->group(function () {
    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });
});
