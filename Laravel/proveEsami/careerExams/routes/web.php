<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ExamController;
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
Route::resource("/careers", CareerController::class);
Route::post("/careers/deleteAll", [CareerController::class, 'deleteAll']);

Route::resource("/exams", ExamController::class);
Route::post("/exams/deleteAll", [ExamController::class, 'deleteAll']);

