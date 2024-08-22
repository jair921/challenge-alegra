<?php

use App\Infrastructure\Http\Controllers\UserOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
        Route::post('/orders', [UserOrderController::class, 'create']);
        Route::get('/orders', [UserOrderController::class, 'index']);
});
