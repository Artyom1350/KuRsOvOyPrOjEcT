<?php

use App\Http\Controllers\AdminController;
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

// Route::middleware(['delineations_users'])->group(function(){
//     //должна быть настройка на админа
// });

Route::get('/admin_panel/home_admin',[AdminController::class, 'index'])->name('home_admin');
Route::get('/admin_panel/user_admin',[AdminController::class, 'userPage'])->name('user_admin');
Route::get('/admin_panel/group_admin',[AdminController::class, 'groupPage'])->name('group_admin');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
//Route::post('/updateStatusDocument',[HomeController::class,'updateStatusDocument'])->middleware('auth');
Route::get('/incAppl', [HomeController::class, 'incApplication'])->name('incApplacation')->middleware('auth');
Route::get('/incAppl/{id}',[HomeController::class,'viewOne'])->name('viewOne')->middleware('auth');

Route::get('/myAppl', [HomeController::class, 'myApplication'])->name('myApplacation')->middleware('auth');
Route::post('/myAppl/addApplication',[HomeController::class,'addApplication'])->middleware('auth');
Route::get('/myAppl/changeApplication/{id}',[HomeController::class,'changeAppl'])->middleware('auth');
Route::get('/myAppl/Download/{id}',[HomeController::class,'downloadAppl'])->middleware('auth');
Route::get('/myAppl/doItAppl', [HomeController::class, 'doApplication'])->name('doApplacation')->middleware('auth');;

Route::get('/allAppl', [HomeController::class, 'allApplication'])->name('allApplacation')->middleware('auth');

Route::post('/getDocument',[HomeController::class,'getDocument'])->middleware('auth');
Route::post('/changeApplSend',[HomeController::class,'changeApplSend'])->middleware('auth');
Route::get('/getUsers',[HomeController::class,'getUsers'])->middleware('auth');
Route::get('/getDepartment',[HomeController::class,'getDepartment'])->middleware('auth');

Route::post('/updateStatusDocument',[HomeController::class,'updateStatusDocument'])->middleware('auth');
Route::post('/myAppl/deleteDoc',[HomeController::class,'deleteDocument'])->middleware('auth');
Route::post('/getAnswersUsers',[HomeController::class,'getUnswersUsers'])->middleware('auth');