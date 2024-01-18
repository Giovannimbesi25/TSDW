<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlistController;
use App\Http\Controllers\WlistController;

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

Route::get('/', [FlistController::class, 'welcome'])->name('flist.welcome');
Route::post('/search', [FlistController::class, 'search'])->name('flist.search');
Route::post('/', [WlistController::class, 'insert'])->name('wlist.insert');
Route::get('/wlist', [WlistController::class, 'list'])->name('wlist.welcome');
Route::post('/wlist', [WlistController::class, 'truncate'])->name('wlist.truncate');
