<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TokenGeneratorController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function() {
    Route::get('user', [UserController::class, 'show']);
});

Route::apiResource('products', ProductController::class);
Route::post('token/generator', TokenGeneratorController::class);
Route::get('search', SearchController::class);
