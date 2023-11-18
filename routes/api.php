<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Offer\Controllers\OfferController;
use App\Http\Controllers\Order\Controllers\OrderController;
use App\Http\Controllers\Product\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return [
        'name' => $request->user()->name,
        'email' => $request->user()->email,
    ];
});

Route::middleware(['auth:sanctum', 'throttle:100,1'])->group(function () {
    Route::resource('/products', ProductController::class);
});

Route::middleware(['auth:sanctum', 'throttle:200,60'])->group(function () {
    Route::resource('/offers', OfferController::class);
});

Route::middleware(['auth:sanctum', 'throttle:500,1440'])->group(function () {
    Route::resource('/orders', OrderController::class);
});
