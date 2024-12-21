<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompetitionController;



Route::get('/users', [UsersController::class,'getUsers']);
Route::get('/users/{id}', [UsersController::class,'getUser']);
Route::post('/users', [UsersController::class,'setUser']);
Route::put('/users/{id}', [UsersController::class, 'updateUser']);
Route::delete('/users/{id}', [UsersController::class, 'deleteUser']);

Route::get('/event', [EventController::class,'getEvents']);
Route::get('/event/{id}', [EventController::class,'getEvent']);
Route::post('/event', [EventController::class,'setEvent']);


Route::get('/competition', [CompetitionController::class,'getCompetitions']);
Route::get('/competition/{id}', [CompetitionController::class,'getCompetition']);
