<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Test route
Route::get('/test', function () {
    return response()->json([
        'message' => 'API is working in Laravel 12 🚀'
    ]);
});

// CRUD routes
Route::post('/posts', [PostController::class, 'store']); // Create
Route::get('/posts', [PostController::class, 'index']);  // Get all
