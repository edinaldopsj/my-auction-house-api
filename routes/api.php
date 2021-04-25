<?php

use App\Http\Controllers\API\BidController;
use App\Http\Controllers\API\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// User auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Item routes
Route::apiResource('items', ItemController::class);

// Bid Routes
Route::apiResource('bids', BidController::class);
