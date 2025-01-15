<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Api Clienti
Route::get('clients', [ClientController::class, 'index']);
Route::put('clients/{id}', [ClientController::class, 'update']);
Route::post('clients', [ClientController::class, 'store']);
Route::delete('clients/{id}', [ClientController::class, 'destroy']);

// Api Veicoli
Route::get('vehicles', [VehicleController::class, 'index']);
Route::post('vehicles', [VehicleController::class, 'store']);
Route::delete('vehicles/{id}', [VehicleController::class, 'destroy']);

// Api Interventi
Route::get('services', [ServiceController::class, 'index']);
Route::post('services', [ServiceController::class, 'store']);
Route::delete('services/{id}', [ServiceController::class, 'destroy']);