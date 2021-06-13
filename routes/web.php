<?php

use App\Http\Controllers\LivroCaixaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LivroCaixaController::class, 'index'])->name('registro.index');
Route::get('/novo', [LivroCaixaController::class, 'create'])->name('registro.create');
Route::post('/salvar', [LivroCaixaController::class, 'store'])->name('registro.store');
Route::get('/apagar/{id}', [LivroCaixaController::class, 'destroy'])->name('registro.delete');
Route::get('/historico', [LivroCaixaController::class, 'historico'])->name('registro.historico');
Route::post('/get-historico', [LivroCaixaController::class, 'getHistorico'])->name('registro.get-historico');