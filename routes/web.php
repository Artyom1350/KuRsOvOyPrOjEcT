<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Users\Admin\AdminViewController;
use App\Http\Controllers\Users\User\UserDataController;
use App\Http\Controllers\Users\User\UserViewController;
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
Route::middleware('auth')->group(function () {
    Route::middleware('isUser')->group(function () {
        ////выдача токена юзера после авторизации
        //Route::get('/login/login_token', function () {
        //    //auth()->user()->createToken('user');
        //    return redirect(route('home'));
        //})->name('login_user');
        //представления
        Route::get('/home', [UserViewController::class, 'index'])->name('home');
        Route::get('/inclAppl', [UserViewController::class, 'incApplication'])->name('incApplication');
        Route::get('/incAppl/{id}', [UserViewController::class, 'viewOne'])->name('viewOne');
        Route::get('/myAppl', [UserViewController::class, 'myApplication'])->name('myApplication');
        Route::get('/allAppl', [UserViewController::class, 'allApplication'])->name('allApplication');
        Route::get('/myAppl/doItAppl', [UserViewController::class, 'doApplication'])->name('doApplication');
        Route::get('/myAppl/changeApplication/{id}', [UserViewController::class, 'changeAppl']);
        //Скачивание документа
        Route::get('/myAppl/Download/{id}', [UserDataController::class, 'downloadAppl']);
    });

    Route::middleware('isAdmin')->group(function () {
        //выдача токена админа после авторизации
        Route::get('/login/admin_token', function () {
            //auth()->user()->createToken('admin');
            return redirect(route('home_admin'));
        })->name('login_admin');

        //Получение токена из бд для апи
        Route::get('/admin_panel/home_admin', [AdminViewController::class, 'index'])->name('home_admin'); //главная админа
        Route::get('/admin_panel/user_admin', [AdminViewController::class, 'userPage'])->name('user_admin'); //юзеры
        Route::get('/admin_panel/group_admin', [AdminViewController::class, 'groupPage'])->name('group_admin'); //группы
    });


    //кастомный выход с удалением токена
    Route::post('/userLogout', function () {
        if (Auth::check()) {
            //Auth::user()->tokens()->delete();
            Auth::logout();
            return redirect('/');
        }
    });
});
