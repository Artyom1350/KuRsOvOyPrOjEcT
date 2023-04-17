<?php

use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Http\Controllers\Users\Admin\AdminDataController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//апи юзера
Route::post('/addApplication', [HomeController::class, 'addApplication']);
Route::post('/getUsers', [HomeController::class, 'getUsers']);
Route::post('/addApplication', [HomeController::class, 'addApplication']);
Route::post('/getDocument', [HomeController::class, 'getDocument']);
Route::post('/changeApplSend', [HomeController::class, 'changeApplSend']);
Route::post('/updateStatusDocument', [HomeController::class, 'updateStatusDocument']);
Route::post('/getUnswersUsers', [HomeController::class, 'getUnswersUsers']);

//апи админа

//работа с юзерами
Route::post('/admin/getOneUser', [AdminDataController::class, 'getOneUser']);
Route::post('/admin/getAllDepartments', [AdminDataController::class, 'getAllDepartments']);
Route::post('/admin/getDepartmentParts', [AdminDataController::class, 'getDepartmentParts']);
Route::post('/admin/addUser', [AdminController::class, 'addUser']);
Route::post('/admin/changeUser', [AdminController::class, 'changeUser']);
Route::post('/admin/destroyUser', [AdminController::class, 'destroyUser']);

//работа с группами
Route::post('/admin/getPostGroup', [AdminDataController::class, 'getPostGroup']);
Route::post('/admin/addGroup', [AdminController::class, 'addGroup']);
Route::post('/admin/destroyGroup', [AdminController::class, 'destroyGroup']);
Route::post('/admin/changeGroup', [AdminController::class, 'changeGroup']);
Route::post('/admin/addPost', [AdminController::class, 'addPost']);
Route::post('/admin/destroyPost', [AdminController::class, 'destroyPost']);
Route::post('/admin/changePost', [AdminController::class, 'changePost']);

//импорт/экспорт
Route::post('/admin/downloadUser', [ExcelController::class, 'getUsers']);
Route::post('/admin/downloadGroupsAndParts', [ExcelController::class, 'getGroupsAndParts']);
Route::post('/admin/importUsers', [ExcelController::class, 'importUsers']);
Route::post('/admin/importGroupsAndPosts', [ExcelController::class, 'importGroupsAndPosts']);

//Новое апи
Route::post('/myAppl/getAnswersUsers', [UserDataController::class, 'getUnswersUsers']);
Route::post('/myAppl/getUsers',[UserDataController::class,'getUsers']);
Route::post('/myAppl/getDepartment', [UserDataController::class, 'getDepartment']);

Route::post('/myAppl/addApplication', [UserCrudController::class, 'addApplication']);
Route::post('/myAppl/changeApplSend', [UserCrudController::class, 'changeApplSend']);
Route::post('/myAppl/deleteDoc', [UserCrudController::class, 'deleteDocument']);

Route::post('/incAppl/updateStatusDocument', [UserCrudController::class, 'updateStatusDocument']);


