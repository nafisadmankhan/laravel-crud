<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\GoogleController;

Route::apiResource('products', ProductController::class);

// Google Auth
Route::get('/auth/google/url',      [GoogleController::class, 'redirectUrl']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleCallback']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});