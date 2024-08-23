<?php

use App\Infrastructure\Http\Controllers\OrderController;
use App\Infrastructure\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::prefix('recipes')->group(function () {
        Route::get('/', [RecipeController::class, 'index']);
        Route::get('/random', [RecipeController::class, 'getRandom']);
        Route::get('{id}', [RecipeController::class, 'show']);
    });

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'createOrder']);
        Route::get('/{order}', [OrderController::class, 'show']);
        Route::post('/{order}/prepare', [OrderController::class, 'prepareOrder']);
    });
});
