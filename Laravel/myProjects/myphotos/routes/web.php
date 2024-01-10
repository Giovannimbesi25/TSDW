<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyFirstController;
use App\Http\Controllers\Admin\PhotoController;
 
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

//route di default
Route::get('/', function () {
    return view('welcome');
});

//Nuova route "hello" più parametro. Può restituire direttamente qualcosa oppure una view
Route::get('/hello/{param}', function ($param) {

    $model = [
        "p1" => "<h1>$param</h1>",
        "p2" => "World"
    ];


    return view('hello-view', $model);
});

//Nuovo controller creato con php artisan make:controller <nome-controller>
//Specifico anche la funzione del controller da utilizzare
Route::get('/hello-controller/{param1}/{param2}', [MyFirstController::class, 'index']);

//Query params
Route::get('/hello-controller-query', [MyFirstController::class, 'queryParam']);


//O le elenco una ad una
// Route::get('photos', [PhotoController::class, 'index']);
// Route::post('photos', [PhotoController::class, 'store']);

Route::resource('photos', PhotoController::class);