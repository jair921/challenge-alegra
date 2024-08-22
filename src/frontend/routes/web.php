<?php

use App\Http\Controllers\KitchenController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [KitchenController::class, 'orders'])->name('kitchen.orders');
Route::get('/warehouse/ingredients', [WarehouseController::class, 'ingredients'])->name('warehouse.ingredients');
Route::get('/warehouse/purchases', [WarehouseController::class, 'purchases'])->name('warehouse.purchases');
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

Route::post('/recipes/order', [RecipeController::class, 'createOrder'])->name('recipes.createOrder');
