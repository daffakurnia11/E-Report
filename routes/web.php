<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Equipment\ElectricController;
use App\Http\Controllers\Equipment\GasController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Planning\ElectricPlanController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectPlanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\Block;
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
    // Administrator
    Route::middleware('admin')->group(function () {
        Route::resource('user', UserController::class)->except(['show']);
        Route::get('user/{user}/resetpass', [UserController::class, 'resetpass']);
    });
    // General Manager
    Route::middleware('gm')->group(function () {
        // Project Management
        Route::post('project/{project}', [ProjectController::class, 'update']);
        Route::get('project/{project}/mark-as-done', [ProjectController::class, 'mark_as_done']);
        Route::post('project/{project}/add-pm', [ProjectController::class, 'add_pm']);
        Route::resource('project', ProjectController::class)->except(['create', 'edit', 'update']);
        // Project Planning
        Route::prefix('planning')->group(function () {
            Route::get('/electric', [ElectricPlanController::class, 'index']);
            Route::post('electric/create/{project}', [ElectricPlanController::class, 'create']);
            Route::get('/electric/{project}', [ElectricPlanController::class, 'show']);
            Route::post('/electric/{project}/{projectPlan}', [ElectricPlanController::class, 'update']);
        });
    });
    // Project Manager
    Route::middleware('pm')->group(function () {
        Route::get('my-project', [ProjectController::class, 'pm_project']);
        Route::prefix('my-project/{project}')->controller(BlockController::class)->group(function () {
            // Block Managements
            Route::get('/blocks', 'index');
            Route::post('/blocks', 'store');
            Route::get('/blocks/{block}', 'show');
            Route::post('/blocks/{block}', 'update');
            Route::delete('/block/{block}', 'destroy');
            // Reports
            Route::get('/report', 'report');
            Route::get('/report/monthly-usage-data', 'monthly_usage');
        });
    });
    // Person In Charge
    Route::middleware('pic')->group(function () {
        Route::prefix('my-block')->group(function () {
            Route::controller(BlockController::class)->group(function () {
                Route::get('/', 'pic_block');
                Route::get('/approval/{block}', 'approval');
                Route::get('/update/{block}', 'update_status');
            });
            Route::controller(EquipmentController::class)->group(function () {
                Route::get('/{block}', 'index');
                Route::post('/{block}', 'store');
                Route::get('/{block}/{equipment}', 'show');
                Route::post('/{block}/{equipment}', 'update');
                Route::delete('/{block}/{equipment}', 'destroy');
                Route::get('/{block}/{equipment}/finished', 'finished');
            });
        });
        Route::prefix('equipment')->group(function () {
            // Gas Equipment
            Route::post('gas/{equipmentGas}', [GasController::class, 'update']);
            Route::resource('gas', GasController::class)->parameters(['gas' => 'equipmentGas'])->except(['create', 'edit', 'update']);
            // Electric Equipment
            Route::post('electric/{equipmentElectric}', [ElectricController::class, 'update']);
            Route::resource('electric', ElectricController::class)->parameters(['electric' => 'equipmentElectric'])->except(['create', 'edit', 'update']);
        });
        Route::get('report-usage/{block}', [EquipmentController::class, 'get_report']);
    });
});
