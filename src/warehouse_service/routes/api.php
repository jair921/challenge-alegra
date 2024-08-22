<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('validate.token')->prefix('v1')->group(function () {

});
