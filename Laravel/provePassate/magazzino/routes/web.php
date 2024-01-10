<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MagazzinoController;

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

Route::get('/', [MagazzinoController::class, 'index'])->name('magazzino.index');
Route::post('/', [MagazzinoController::class, 'aggiungi'])->name('magazzino.aggiungi');
Route::post('/{prodotto}', [MagazzinoController::class, 'compra'])->name('magazzino.compra');
Route::delete('/{prodotto}', [MagazzinoController::class, 'elimina'])->name('magazzino.elimina');
