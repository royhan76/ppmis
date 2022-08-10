<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\GradeController;
use App\Http\Controllers\API\BillController;
use App\Http\Controllers\API\DormitoryController;
use App\Http\Controllers\API\FoulController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RoomController;
use App\Http\Controllers\API\SeasonController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\LessonValueController;


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

Route::resource('api-student', StudentController::class);
Route::resource('api-teacher', TeacherController::class);
Route::resource('api-user', UserController::class);
Route::resource('api-grade', GradeController::class);
Route::resource('api-bill', BillController::class);
Route::resource('api-dormitory', DormitoryController::class);
Route::resource('api-foul', FoulController::class);
Route::resource('api-role', RoleController::class);
Route::resource('api-room', RoomController::class);
Route::resource('api-season', SeasonController::class);


Route::resource('api-lesson', LessonController::class);
Route::resource('api-lesson-value', LessonValueController::class);
Route::post('api/login', [ApiController::class, 'authenticate']);
Route::post('api/register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
});
