<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\API\AuthController;

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

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('logout',[AuthController::class,'logout']);

    // Student CRUD
    Route::post('student/add',[StudentController::class,'Add']);
    Route::get('student',[StudentController::class,'viewAll']);
    Route::get('student/{id}',[StudentController::class,'viewOneStud']);
    Route::put('student/update/{id}',[StudentController::class,'update']);
    Route::delete('student/delete/{id}',[StudentController::class,'destroy']);
    //Teacher CRUD
    Route::post('teacher/add',[TeacherController::class,'Add']);
    Route::get('teacher',[TeacherController::class,'viewAll']);
    Route::get('teacher/{id}',[TeacherController::class,'viewOneteach']);
    Route::put('teacher/update/{id}',[TeacherController::class,'update']);
    Route::delete('teacher/delete/{id}',[TeacherController::class,'destroy']);
    
});


