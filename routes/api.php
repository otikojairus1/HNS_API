<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [\App\Http\Controllers\UserController::class, "register"]);
Route::post('/login', [\App\Http\Controllers\UserController::class, "login"]);
Route::post('/add/meeting', [\App\Http\Controllers\UserController::class, "addMeeting"]);
Route::get('/meetings', [\App\Http\Controllers\UserController::class, "viewMeetings"]);
Route::post('/add/schedule', [\App\Http\Controllers\UserController::class, "addSchedule"]);
Route::get('/schedules', [\App\Http\Controllers\UserController::class, "viewSchedules"]);
Route::post('/add/occurence', [\App\Http\Controllers\UserController::class, "addOccurence"]);
Route::get('/occurences', [\App\Http\Controllers\UserController::class, "getOccurence"]);
