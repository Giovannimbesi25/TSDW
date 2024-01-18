<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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

Route::view('/', 'home');
Route::resource('/projects', ProjectController::class);
Route::post('/projects/help_show/', [ProjectController::class, 'help_show']);
Route::delete('/projects', [ProjectController::class, 'destroyAll']);


Route::resource('/tasks', TaskController::class);
Route::post('/tasks/create', [TaskController::class, 'help_create']);
Route::post('/projects/help_show/', [TaskController::class, 'help_show']);
Route::delete('/tasks', [TaskController::class, 'destroyAll']);

