<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\App\TokoController;
use App\Http\Controllers\Api\App\ProdukController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Register route and login route
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    //route for toko
    Route::get('toko/index', [TokoController::class, 'index'])->middleware('auth:sanctum');
    Route::post('toko/store', [TokoController::class, 'store'])->middleware('auth:sanctum');
    Route::get('toko/show/{id}', [TokoController::class, 'show'])->middleware('auth:sanctum');
    Route::put('toko/update/{id}', [TokoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('toko/delete/{id}', [TokoController::class, 'destroy'])->middleware('auth:sanctum');

    //route for produk
    Route::get('produk/index', [ProdukController::class, 'index'])->middleware('auth:sanctum');
    Route::post('produk/store', [ProdukController::class, 'store'])->middleware('auth:sanctum');
    Route::get('produk/show/{id}', [ProdukController::class, 'show'])->middleware('auth:sanctum');
    Route::put('produk/update/{id}', [ProdukController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('produk/delete/{id}', [ProdukController::class, 'destroy'])->middleware('auth:sanctum');
    
});
