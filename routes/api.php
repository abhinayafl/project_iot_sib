<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TemperatureController;
use App\Http\Controllers\Api\HumidityController;
use App\Http\Controllers\Api\MoistureController;
use App\Http\Controllers\Api\IntensityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ----------------------------------CONTROLLER SENSOR--------------------------------

// Routes untuk Temperature

Route::post('/temperatures', [TemperatureController::class, 'store']); // Route POST untuk data temperatur
Route::get('/temperatures', [TemperatureController::class, 'index']); // Route GET untuk mengambil semua data temperatur
Route::get('/temperatures/{id}', [TemperatureController::class, 'show']); // Route GET untuk mengambil data temperatur berdasarkan ID

// Routes untuk Humidity
Route::post('/humidities', [HumidityController::class, 'store']);
Route::get('/humidities', [HumidityController::class, 'index']);
Route::get('/humidities/{id}', [HumidityController::class, 'show']);

// Routes untuk Moisture
Route::post('/moistures', [MoistureController::class, 'store']);
Route::get('/moistures', [MoistureController::class, 'index']);
Route::get('/moistures/{id}', [MoistureController::class, 'show']);

// Routes untuk Intensity
Route::post('/intensities', [IntensityController::class, 'store']);
Route::get('/intensities', [IntensityController::class, 'index']);
Route::get('/intensities/{id}', [IntensityController::class, 'show']);

//-----------------------------------------------------------------------------------
