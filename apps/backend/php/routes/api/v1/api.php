<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\v1\ProductStatusController;
use App\Http\Controllers\Api\v1\RentalPeriodController;
use App\Http\Controllers\Api\v1\RentController;
use App\Http\Controllers\Api\v1\SaleController;
use App\Http\Controllers\Api\v1\UserController;
use Illuminate\Support\Facades\Route;


Route::name('api.')->group(function () {
    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::group(['middleware' => ['auth:api']], function () {
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');

    Route::get('product_statuses', [ProductStatusController::class, 'index'])->name('product_statuses.index');
    Route::get('product_statuses/{id}', [ProductStatusController::class, 'show'])->name('product_statuses.show');

    Route::get('rental_periods', [RentalPeriodController::class, 'index'])->name('rental_periods.index');
    Route::get('rental_periods/{id}', [RentalPeriodController::class, 'show'])->name('rental_periods.show');

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');

    Route::get('sale', [SaleController::class, 'index'])->name('sale.index');
    Route::get('sale/{id}', [SaleController::class, 'show'])->name('sale.show');

    Route::get('rent', [RentController::class, 'index'])->name('rent.index');
    Route::get('rent/{id}', [RentController::class, 'show'])->name('rent.show');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('sale', [SaleController::class, 'store'])->name('sale.store');
        Route::post('rent', [RentController::class, 'store'])->name('rent.store');
    });
});
