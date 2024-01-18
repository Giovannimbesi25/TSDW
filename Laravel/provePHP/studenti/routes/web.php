<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
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

Route::get('/', [StudentController::class, 'list'])->name("student.list");
Route::get('/about/{id}', [StudentController::class, 'about'])->name("student.about");
Route::post('/addStudent', [StudentController::class, 'addStudent'])->name("student.addStudent");
Route::post('/editStudent', [StudentController::class, 'editStudent'])->name("student.editStudent");
Route::post('/deleteStudent/{id}', [StudentController::class, 'deleteStudent'])->name("student.deleteStudent");
