<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// v1 api
Route::middleware('auth:api')->prefix("v1")->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //Routes to microservices

});
