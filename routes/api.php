<?php

use App\Http\Controllers\Api\productcontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('products', productcontroller::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
