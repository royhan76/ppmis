<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SlideshowController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;

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
            'index', 'edit', 'update'
        ]);
        Route::resource('profile', ProfileController::class)->only([
            'index', 'edit', 'update'
        ]);
        Route::get('', DashboardController::class)->name('dashboard');
        Route::redirect('dashboard', '/admin');
    });

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);
Route::get('/', [HomeController::class, 'index']);
Route::prefix('/')->group(function () {
    Route::get('detail/{id}', [HomeController::class, 'articleDetail']);
});
// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
// });


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
