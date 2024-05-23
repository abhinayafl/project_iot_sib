<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TemperatureController;

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

// -----------CONTROLLER SENSOR------------------------

//--------------------------------------------------------------------------------

// Controller dari temperature

// Route GET untuk mengambil semua data temperatur
Route::post('/temperatures', [TemperatureController::class, 'store']);

// Route GET untuk mengambil semua data temperatur
Route::get('/temperatures', [TemperatureController::class, 'index']);

// Route GET untuk mengambil data temperatur berdasarkan ID
Route::get('/temperatures/{id}', [TemperatureController::class, 'show']);

//--------------------------------------------------------------------------------
