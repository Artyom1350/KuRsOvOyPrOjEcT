<?php

use App\Http\Controllers\DBApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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
<<<<<<< HEAD
Route::post('/addApplication',[HomeController::class,'addApplication']);
Route::get('/getUsers',[HomeController::class,'getUsers']);
Route::post('/addApplication',[HomeController::class,'addApplication']);
Route::post('/getDocument',[HomeController::class,'getDocument']);
Route::post('/changeApplSend',[HomeController::class,'changeApplSend']);

=======

Route::get('/groupsPeople', [DBApiController::class, 'getGroupsPeop']);
>>>>>>> e6a9a40bc05dda522c080efdb34ba4a385760546
