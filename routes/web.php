<?php

use App\Http\Controllers\HomeController;
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

Route::redirect('/', 'home');

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/myAppl', [HomeController::class, 'myApplication'])->name('myApplacation');

Route::get('/incAppl', [HomeController::class, 'incApplication'])->name('incApplacation');

Route::get('/allAppl', [HomeController::class, 'allApplication'])->name('allApplacation');

Route::get('/doItAppl', [HomeController::class, 'doApplication'])->name('doApplacation');
