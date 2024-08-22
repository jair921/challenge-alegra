<?php

use App\Infrastructure\Http\Controllers\IngredientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {
    Route::get('/ingredients', [IngredientController::class, 'index']);
    Route::post('/ingredients/order', [IngredientController::class, 'order']);
    Route::post('/ingredients/add', [IngredientController::class, 'add']);
});
