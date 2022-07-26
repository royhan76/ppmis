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

Route::resource('user', UserController::class);
Route::resource('grade', GradeController::class);
Route::resource('bill', BillController::class);
Route::resource('dormitory', DormitoryController::class);
Route::resource('foul', FoulController::class);
Route::resource('role', RoleController::class);
Route::resource('room', RoomController::class);
Route::resource('season', SeasonController::class);

Route::post('login', [ApiController::class, 'authenticate']);
// Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);

    Route::get('/student/{id}', [StudentController::class, 'getStudent']);
    Route::get('/student-bill/{id}', [StudentController::class, 'getStudentBill']);
    Route::get('/student-foul/{id}', [StudentController::class, 'getStudentFoul']);
    Route::get('test', [StudentController::class, 'index']);
});
