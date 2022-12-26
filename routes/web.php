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

Route::redirect('/', 'login');

Auth::routes();

Route::get('/incAppl/{id}',[HomeController::class,'viewOne'])->name('viewOne')->middleware('auth');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/myAppl', [HomeController::class, 'myApplication'])->name('myApplacation')->middleware('auth');;

Route::get('/incAppl', [HomeController::class, 'incApplication'])->name('incApplacation')->middleware('auth');;

Route::get('/allAppl', [HomeController::class, 'allApplication'])->name('allApplacation')->middleware('auth');;

Route::get('/doItAppl', [HomeController::class, 'doApplication'])->name('doApplacation')->middleware('auth');;
