<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DespesaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('/despesas', DespesaController::class);
});