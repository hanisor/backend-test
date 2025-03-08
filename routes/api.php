<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrdersController;

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // UserController
    Route::apiResource('/users', UserController::class);
    Route::post('/profile/upload',  [UserController::class, 'uploadProfilePicture']);
    Route::post('/upload-ic-passport', [UserController::class, 'uploadICPassport']);
    Route::get('/download-ic-passport', [UserController::class, 'downloadICPassport']);

    // OrderController
    Route::get('/user-orders', [OrdersController::class, 'getUserOrders']);
    Route::post('/place-order', [OrdersController::class, 'placeOrder']);
});
