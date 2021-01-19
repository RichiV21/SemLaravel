<?php

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

Route::get('/', [App\Http\Controllers\ProduktController::class, 'index']);
Route::get('/produkt/create', [App\Http\Controllers\ProduktController::class, 'create'])->middleware('role:admin');;
Route::get('/produkt/{produkt}', [App\Http\Controllers\ProduktController::class, 'show']);
Route::get('/produkt/kategoria/{kategoria}', [App\Http\Controllers\ProduktController::class, 'getByKategoria']);


Auth::routes();
Route::get('/kosik', [App\Http\Controllers\KosikController::class, 'index']);
Route::post('/kosik', [App\Http\Controllers\KosikController::class, 'store']);
Route::put('/kosik', [App\Http\Controllers\KosikController::class, 'update']);
Route::delete("/kosik", [App\Http\Controllers\KosikController::class, 'destroy']);

Route::post('/produkt', [App\Http\Controllers\ProduktController::class, 'store'])->middleware('role:admin');;
Route::get('/produkt/{produkt}/edit', [App\Http\Controllers\ProduktController::class, 'edit'])->middleware('role:admin');;
Route::put('/produkt/{produkt}', [App\Http\Controllers\ProduktController::class, 'update'])->middleware('role:admin');;
Route::delete('/produkt/{produkt}', [App\Http\Controllers\ProduktController::class, 'destroy'])->middleware('role:admin');;

Route::get('/objednavky', [App\Http\Controllers\ObjednavkaController::class, 'index']);
Route::get('/objednavky/{objednavka}', [App\Http\Controllers\ObjednavkaController::class, 'show']);
Route::post('/objednavky', [App\Http\Controllers\ObjednavkaController::class, 'store']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

