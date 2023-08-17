<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/url', [App\Http\Controllers\UrlController::class, 'store'])->name('url.store');

Route::get('/url/{url}/edit', [App\Http\Controllers\UrlController::class, 'edit'])->name('url.edit');

Route::delete('/url/{url}', [App\Http\Controllers\UrlController::class, 'destroy'])->name('url.destroy');

Route::patch('/url/{url}', [App\Http\Controllers\UrlController::class, 'update'])->name('url.update');

Route::get('/{hash}', [App\Http\Controllers\UrlController::class, 'redirect'])->name('url.redirect');