<?php

use App\Http\Controllers\CarroController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
// });

Route::get('/carro', [CarroController::class, 'index']);
Route::get('/carro/{id}', [CarroController::class, 'show']);
Route::post('/carro', [CarroController::class, 'store']);
Route::put('/carro/{id}', [CarroController::class, 'update']);
Route::delete('/carro/{id}', [CarroController::class, 'destroy']);
