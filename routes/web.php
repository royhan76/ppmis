<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SlideshowController;

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

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::resources([
            'user' => UserController::class,
            'category' => CategoryController::class,
            'article' => ArticleController::class,
            'slideshow' => SlideshowController::class,
        ]);
        Route::resource('contact', ContactController::class)->only([
            'index', 'show', 'update'
        ]);
        Route::resource('profile', ProfileController::class)->only([
            'index', 'show', 'update'
        ]);
    });

Auth::routes();
Route::get('/', function () {
    return view('layouts.home.home');
});
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
