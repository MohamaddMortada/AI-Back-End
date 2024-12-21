<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/', [UserController::class,'getUsers']);
Route::get('/{id}', [UserController::class,'getUser']);
Route::post('/', [UserController::class,'setUser']);