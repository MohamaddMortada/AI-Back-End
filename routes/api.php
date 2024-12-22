<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\PredictionController;



Route::get('/users', [UsersController::class,'getUsers']);
Route::get('/users/{id}', [UsersController::class,'getUser']);
Route::post('/users', [UsersController::class,'setUser']);
Route::put('/users/{id}', [UsersController::class, 'updateUser']);
Route::delete('/users/{id}', [UsersController::class, 'deleteUser']);

Route::get('/event', [EventController::class,'getEvents']);
Route::get('/event/{id}', [EventController::class,'getEvent']);
Route::post('/event', [EventController::class,'setEvent']);
Route::put('/event/{id}', [EventController::class,'updateEvent']);
Route::delete('/event/{id}', [EventController::class,'deleteEvent']);


Route::get('/competition', [CompetitionController::class,'getCompetitions']);
Route::get('/competition/{id}', [CompetitionController::class,'getCompetition']);
Route::post('/competition', [CompetitionController::class,'setCompetition']);
Route::put('/competition/{id}', [CompetitionController::class,'updateCompetition']);
Route::delete('/competition/{id}', [CompetitionController::class,'deleteCompetition']);

Route::get('/prediction', [PredictionController::class,'getPredictions']);
Route::get('/prediction/{id}', [PredictionController::class,'getPrediction']);
Route::post('/prediction', [PredictionController::class,'setPrediction']);
Route::put('/prediction/{id}', [PredictionController::class,'updatePrediction']);
Route::delete('/prediction/{id}', [PredictionController::class,'deletePrediction']);
