<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LetteraController;
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

Route::resource('letteras', LetteraController::class);

Route::get('/letteras/befana/bonus',[LetteraController::class, 'befana']);
Route::post('/letteras/consegna/{id}', [LetteraController::class, 'consegna']);