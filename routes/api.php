<?php

use App\Http\Controllers\DBApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

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
Route::post('/addApplication',[HomeController::class,'addApplication']);
Route::post('/getUsers',[HomeController::class,'getUsers']);
Route::post('/addApplication',[HomeController::class,'addApplication']);
Route::post('/getDocument',[HomeController::class,'getDocument']);
Route::post('/changeApplSend',[HomeController::class,'changeApplSend']);
Route::post('/updateStatusDocument',[HomeController::class,'updateStatusDocument']);
Route::post('/getUnswersUsers',[HomeController::class,'getUnswersUsers']);

//апи админа

Route::post('/admin/getOneUser',[AdminController::class, 'getOneUser']);
Route::post('/admin/getAllDepartments',[AdminController::class,'getAllDepartments']);
Route::post('/admin/getDepartmentParts',[AdminController::class,'getDepartmentParts']);
Route::post('/admin/addUser',[AdminController::class,'addUser']);
Route::post('/admin/changeUser',[AdminController::class,'changeUser']);
Route::post('/admin/destroyUser',[AdminController::class,'destroyUser']);

Route::post('/admin/getPostGroup',[AdminController::class,'getPostGroup']);
Route::post('/admin/addGroup',[AdminController::class,'addGroup']);
Route::post('/admin/destroyGroup',[AdminController::class,'destroyGroup']);
Route::post('/admin/changeGroup',[AdminController::class,'changeGroup']);
Route::post('/admin/addPost',[AdminController::class,'addPost']);
Route::post('/admin/destroyPost',[AdminController::class,'destroyPost']);
Route::post('/admin/changePost',[AdminController::class,'changePost']);

/*Route::post('/admin/downloadUser',function(){
    return Excel::download(new UsersExport, 'users.xlsx');
});*/
Route::post('/admin/downloadUser',[ExcelController::class, 'getArray']);