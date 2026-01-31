<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::controller(CategoryController::class)->prefix('category')->group(function(){
    Route::get('/', 'list');                 // GET all categories
    Route::post('/store', 'store');          // POST create
    Route::get('/edit/{id}', 'edit');        // GET single category
    Route::patch('/update/{id}', 'update');  // PATCH update
    Route::delete('/delete/{id}', 'delete'); // DELETE category
});
