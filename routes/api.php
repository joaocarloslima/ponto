<?php

use App\Http\Controllers\RegistroController;
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

//get test
Route::get('/', function () {
    return response()->json([
        'message' => 'API - 1.0'
    ]);
});

Route::post('/registrar', [RegistroController::class, 'registrar']);
Route::get('/dashboard', [RegistroController::class, 'dashboard']);
