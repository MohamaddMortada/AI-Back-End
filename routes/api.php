<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventController;



Route::get('/users', [UsersController::class,'getUsers']);
Route::get('/users/{id}', [UsersController::class,'getUser']);
Route::post('/users', [UsersController::class,'setUser']);
Route::put('/users/{id}', [UsersController::class, 'updateUser']);
Route::delete('/users/{id}', [UsersController::class, 'deleteUser']);

Route::get('/events', [EventController::class,'getEvents']);
Route::get('/events/{id}', [EventController::class,'getEvent']);
