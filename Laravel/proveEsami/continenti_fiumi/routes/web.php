<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiumeController;
use App\Http\Controllers\ContinentController;
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

Route::resource("/fiumes", FiumeController::class);
Route::post("/fiumes/searchByName", [FiumeController::class, 'searchByName']);
Route::post("/fiumes/deleteAll", [FiumeController::class, 'deleteAll']);

Route::resource("/continents", ContinentController::class);

Route::post("/continents/deleteAll", [ContinentController::class, 'deleteAll']);
Route::post("/continents/searchByName", [ContinentController::class, 'searchByName']);
