<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth')->group(function(){
    Route::middleware('isUser')->group(function(){
        //выдача токена юзера после авторизации 
        Route::get('/login/login_token', function() {
            auth()->user()->createToken('user');
            return redirect(route('home'));
        })->name('login_user');

        //Получение токена из бд для апи
        Route::post('/user/token',[HomeController::class,'getUserToken'])->name('takeUserToken');

        //представления
        Route::get('/home', [HomeController::class, 'index'])->name('home'); //календарь + главная
        Route::get('/incAppl', [HomeController::class, 'incApplication'])->name('incApplacation');//все входящие заявки
        Route::get('/incAppl/{id}',[HomeController::class,'viewOne'])->name('viewOne');//1 входящая заявка
        
        Route::get('/myAppl', [HomeController::class, 'myApplication'])->name('myApplacation');//все исходящие заявки
        Route::post('/myAppl/addApplication',[HomeController::class,'addApplication']);//создание заявки
        Route::get('/myAppl/changeApplication/{id}',[HomeController::class,'changeAppl']);//изменение заявки
        Route::get('/myAppl/Download/{id}',[HomeController::class,'downloadAppl']);//скачивание документа

        Route::get('/allAppl', [HomeController::class, 'allApplication'])->name('allApplacation'); //все заявки
        
        //апи
        Route::post('/changeApplSend',[HomeController::class,'changeApplSend']); //для апи изменение
        Route::get('/myAppl/doItAppl', [HomeController::class, 'doApplication'])->name('doApplacation');//для апи создание

        Route::post('/getDocument',[HomeController::class,'getDocument']);

        //Route::post('/getUsers',[HomeController::class,'getUsers']);
        Route::get('/getDepartment',[HomeController::class,'getDepartment']);
        
        Route::post('/updateStatusDocument',[HomeController::class,'updateStatusDocument']);
        Route::post('/myAppl/deleteDoc',[HomeController::class,'deleteDocument']);
        Route::post('/getAnswersUsers',[HomeController::class,'getUnswersUsers']);
        
    });
    
    Route::middleware('isAdmin')->group(function(){
        //выдача токена админа после авторизации 
        Route::get('/login/admin_token', function() {
            auth()->user()->createToken('admin');
            return redirect(route('home_admin'));
        })->name('login_admin');

        //Получение токена из бд для апи
        Route::post('/admin/token',[AdminController::class,'getAdminToken'])->name('takeAdminToken');


        Route::get('/admin_panel/home_admin',[AdminController::class, 'index'])->name('home_admin');//главная админа
        Route::get('/admin_panel/user_admin',[AdminController::class, 'userPage'])->name('user_admin');//юзеры
        Route::get('/admin_panel/group_admin',[AdminController::class, 'groupPage'])->name('group_admin');//группы
    });


    //кастомный выход с удалением токена
    Route::post('/userLogout',function(){
        if(Auth::check()) {
            Auth::user()->tokens()->delete();
            Auth::logout();
            return redirect('/');
        }
    });
});



