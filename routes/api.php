<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\RegisterUserController;

Route::middleware('auth:api')->get('/one', function (Request $request) {
  return $request->user();
});

Route::middleware('auth:api')->group(function () {
  Route::post('/logout', [LoginUserController::class, 'destroy']);
  Route::apiResource('/user', UserController::class);
});

// Route::middleware('guest:api')->group(function() {});

Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/login', [LoginUserController::class, 'store']);
