<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authLogin']);

Route::get('/user-registration', [AuthController::class, 'registration']);
Route::post('/user-registration', [AuthController::class, 'UserRegistration']);

Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'userAdmin'], function () {
    Route::get('panel/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // If need separate dashboard for admin, user and others 
    // Route::get('panel/user-dashboard', [DashboardController::class, 'userDashboard'])->name('panel/user-dashboard');

    Route::prefix('panel/role')->group(function () {
        Route::get('/', [RoleController::class, 'list'])->name('role.index');
        Route::get('add', [RoleController::class, 'add'])->name('role.add');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::post('store', [RoleController::class, 'store'])->name('role.store');
        Route::post('update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::delete('delete/{id}', [RoleController::class, 'delete'])->name('role.delete');
    });
    Route::prefix('panel/user')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('user.index');
        Route::get('add', [UserController::class, 'add'])->name('user.add');
        Route::get('edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });
});
