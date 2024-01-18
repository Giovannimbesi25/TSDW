<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

Route::get('/books', [BookController::class, 'list'])->name('book.list');
Route::get('/books/{id}', [BookController::class, 'detail'])->name('book.detail');
Route::post('/books', [BookController::class, 'aggiungi'])->name('book.aggiungi');

Route::post('/books/{book}', [BookController::class, 'update'])->name('book.update');
Route::delete('/books/{book}', [BookController::class, 'delete'])->name('book.delete');
