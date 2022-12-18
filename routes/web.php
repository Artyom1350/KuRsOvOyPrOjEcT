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

Auth::routes();
Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/myAppl', [HomeController::class, 'myApplication'])->name('myApplacation');

Route::get('/incAppl', [HomeController::class, 'incApplication'])->name('incApplacation');

Route::get('/allAppl', [HomeController::class, 'allApplication'])->name('allApplacation');