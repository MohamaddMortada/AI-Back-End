<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\Athlete_EventController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PointsCalculatorController;
use App\Http\Controllers\DetectController;
use App\Http\Controllers\LiveDetectionController;
use App\Http\Controllers\EventDetectorController;


 
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/me', [AuthController::class, 'me'])->name('me');
});

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

Route::get('/feedback', [FeedbackController::class,'getFeedbacks']);
Route::get('/feedback/{id}', [FeedbackController::class,'getFeedback']);
Route::post('/feedback', [FeedbackController::class,'setFeedback']);
Route::put('/feedback/{id}', [FeedbackController::class,'updateFeedback']);
Route::delete('/feedback/{id}', [FeedbackController::class,'deleteFeedback']);

Route::get('/statistics', [StatisticsController::class,'getStatistics']);
Route::get('/statistics/{id}', [StatisticsController::class,'getStat']);
Route::post('/statistics', [StatisticsController::class,'setStat']);
Route::put('/statistics/{id}', [StatisticsController::class,'updateStat']);
Route::delete('/statistics/{id}', [StatisticsController::class,'deleteStat']);

Route::get('/athlete_event', [Athlete_EventController::class,'getAthlete_Events']);
Route::get('/athlete_event/{id}', [Athlete_EventController::class,'getAthlete_Event']);
Route::post('/athlete_event', [Athlete_EventController::class,'setAthlete_Event']);
Route::put('/athlete_event/{id}', [Athlete_EventController::class,'updateAthlete_Event']);
Route::delete('/athlete_event/{id}', [Athlete_EventController::class,'deleteAthlete_Event']);

Route::post('/points', [PointsCalculatorController::class,'getPoints']);

Route::post('/detect_image', [DetectController::class, 'detectImage']);
Route::post('/detect_video', [DetectController::class, 'detectVideo']);

Route::post('/livedetect', [LiveDetectionController::class, 'runScript']);
