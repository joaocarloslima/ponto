<?php

use App\Http\Controllers\FeriadoController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('funcionarios', FuncionarioController::class);
Route::resource('feriados', FeriadoController::class);

Route::get('inativos', [FuncionarioController::class, 'inativos'])->name('funcionarios.inativos');
Route::put('inativos/{funcionario}', [FuncionarioController::class, 'ativar'])->name('funcionarios.ativar');
