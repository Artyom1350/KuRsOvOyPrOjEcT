<?php
use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Http\Controllers\Users\Admin\AdminDataController;
use App\Http\Controllers\Users\Admin\AdminCrudController;

use App\Http\Controllers\Users\User\UserCrudController;
use App\Http\Controllers\Users\User\UserDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Новое апи
Route::middleware('provApi')->group(function(){
    //user
    Route::post('/myAppl/getAnswersUsers', [UserDataController::class, 'getUnswersUsers']);
    Route::post('/myAppl/getUsers',[UserDataController::class,'getUsers']);
    Route::post('/myAppl/getDepartment', [UserDataController::class, 'getDepartment']);
    Route::post('/myAppl/addApplication', [UserCrudController::class, 'addApplication']);
    Route::post('/myAppl/changeApplSend', [UserCrudController::class, 'changeApplSend']);
    Route::post('/myAppl/deleteDoc', [UserCrudController::class, 'deleteDocument']);
    Route::post('/incAppl/updateStatusDocument', [UserCrudController::class, 'updateStatusDocument']);
    Route::post('/myAppl/Download', [UserDataController::class, 'downloadApplTest']);

    //admin
    //работа с юзерами
    Route::post('/admin/getOneUser', [AdminDataController::class, 'getOneUser']);
    Route::post('/admin/getAllDepartments', [AdminDataController::class, 'getAllDepartments']);
    Route::post('/admin/getDepartmentParts', [AdminDataController::class, 'getDepartmentParts']);
    Route::post('/admin/addUser', [AdminCrudController::class, 'addUser']);
    Route::post('/admin/changeUser', [AdminCrudController::class, 'changeUser']);
    Route::post('/admin/destroyUser', [AdminCrudController::class, 'destroyUser']);

    //работа с группами
    Route::post('/admin/getPostGroup', [AdminDataController::class, 'getPostGroup']);
    Route::post('/admin/addGroup', [AdminCrudController::class, 'addGroup']);
    Route::post('/admin/destroyGroup', [AdminCrudController::class, 'destroyGroup']);
    Route::post('/admin/changeGroup', [AdminCrudController::class, 'changeGroup']);
    Route::post('/admin/addPost', [AdminCrudController::class, 'addPost']);
    Route::post('/admin/destroyPost', [AdminCrudController::class, 'destroyPost']);
    Route::post('/admin/changePost', [AdminCrudController::class, 'changePost']);

    //импорт/экспорт
    Route::post('/admin/downloadUser', [ExcelController::class, 'getUsers']);
    Route::post('/admin/downloadGroupsAndParts', [ExcelController::class, 'getGroupsAndParts']);
    Route::post('/admin/importUsers', [ExcelController::class, 'importUsers']);
    Route::post('/admin/importGroupsAndPosts', [ExcelController::class, 'importGroupsAndPosts']);

});




