<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\StoreController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{categoryId}/stores', [StoreController::class, 'index']);
    Route::get('/stores/{storeId}/products', [ProductController::class, 'index']);
    Route::get('/stores/{storeId}/products/{productId}', [ProductController::class, 'show']);

    Route::post('/cart', [CartController::class, 'add']);
    Route::put('/cart/{cartItemId}', [CartController::class, 'update']);
    Route::delete('/cart/{cartItemId}', [CartController::class, 'destroy']);
    Route::get('/cart', [CartController::class, 'index']);

    Route::post('/order', [OrderController::class, 'store']);


    Route::get('/search', SearchController::class);
});

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->middleware('throttle:5,1');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
