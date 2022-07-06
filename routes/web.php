<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/signin', 'signin')->name('login');
        Route::post('/signin', 'authorization');
        Route::get('/signup', 'signup');
        Route::post('/signup', 'register');
    });
    Route::post('/logout', 'logout')->middleware('auth');
});

Route::middleware('auth')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/profile', 'profile');
        Route::put('/profile/{user}/update', 'updateProfile');
        Route::put('/profile/{user}/changepass', 'changepass');
    });
    Route::resource('user', UserController::class)->except(['create', 'store', 'show']);
    Route::get('user/{user}/resetpass', [UserController::class, 'resetpass']);
});
