<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\TodoistController;
use App\Http\Controllers\S3Controller;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/temp/{zip}', [WeatherController::class,'getTemp']);

Route::get('/todo', [TodoistController::class, 'getTodo']);
Route::get('/todo/{token}/{id}', [TodoistController::class, 'getTasks']);

Route::get('/s3', [S3Controller::class, 'getContent']);
Route::put('/s3', [S3Controller::class, 'putContent']);
