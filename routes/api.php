<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware([''])->group(function () {
        Route::apiResource('/products', ProductController::class);
    });

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('/products', [ProductController::class, 'index']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');