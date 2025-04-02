<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\TokoController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Register route
Route::post('register', [RegisterController::class, 'store']);


Route::post('login', [LoginController::class, 'login']);
Route::get('index', [TokoController::class, 'index'])->middleware('auth:sanctum');
Route::post('store', [TokoController::class, 'store'])->middleware('auth:sanctum');
Route::get('show/{id}', [TokoController::class, 'show'])->middleware('auth:sanctum');
Route::put('update/{id}', [TokoController::class, 'update'])->middleware('auth:sanctum');
Route::delete('delete/{id}', [TokoController::class, 'destroy'])->middleware('auth:sanctum');