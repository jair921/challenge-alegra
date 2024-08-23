<?php

use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WareHouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

// v1 api
Route::middleware('auth:api')->prefix("v1")->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Routes to microservices

    // Endpoint para crear una orden
    Route::post('/orders', [OrderController::class, 'createOrder']);

    // Endpoint para listar órdenes
    Route::get('/orders', [OrderController::class, 'listOrders']);

    Route::get('/kitchen/ramdom', [KitchenController::class, 'ramdon']);
    Route::get('/kitchen/recipes', [KitchenController::class, 'recipes']);

    Route::get('/warehouse/ingredients', [WareHouseController::class, 'ingredients']);

    Route::get('/purchases', [WareHouseController::class, 'purchases']);

});
