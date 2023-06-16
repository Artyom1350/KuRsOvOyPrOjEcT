<?php
use App\Http\Controllers\Users\Admin\AdminViewController;
use App\Http\Controllers\Users\User\UserViewController;
use App\Http\Controllers\Mail\SendMailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isUser;
use App\Http\Middleware\isAdmin;

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
    Route::middleware(isUser::class)->group(function () {
        Route::get('/home', [UserViewController::class, 'index'])->name('home');
        Route::get('/inclAppl', [UserViewController::class, 'incApplication'])->name('incApplication');
        Route::get('/incAppl/{id}', [UserViewController::class, 'viewOne'])->name('viewOne');
        Route::get('/myAppl', [UserViewController::class, 'myApplication'])->name('myApplication');
        Route::get('/allAppl', [UserViewController::class, 'allApplication'])->name('allApplication');
        Route::get('/myAppl/doItAppl', [UserViewController::class, 'doApplication'])->name('doApplication');
        Route::get('/myAppl/changeApplication/{id}', [UserViewController::class, 'changeAppl']);
    });
    Route::middleware(isAdmin::class)->group(function () {
        Route::get('/admin_panel/home_admin', [AdminViewController::class, 'index'])->name('home_admin'); //главная админа
        Route::get('/admin_panel/user_admin', [AdminViewController::class, 'userPage'])->name('user_admin'); //юзеры
        Route::get('/admin_panel/group_admin', [AdminViewController::class, 'groupPage'])->name('group_admin'); //группы
        
        Route::get('/admin_panel/download_template_user',[AdminViewController::class,'downloadTemplateUser'])->name('download_template_user');
        Route::get('/admin_panel/download_template_departments_and_parts',[AdminViewController::class,'downloadTemplateDP'])->name('download_template_departments_and_parts');
    });
    //кастомный выход с удалением токена UPD: токен теперь не надо удалять
    Route::post('/userLogout', function () {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }
    });
});
Route::get('/da',[SendMailController::class,'send']);