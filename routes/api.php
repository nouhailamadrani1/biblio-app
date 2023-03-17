<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;





Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
   
});

Route::apiResource('livre', livreController::class);
Route::apiResource('category',CategoryController::class);
