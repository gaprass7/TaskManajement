<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TaskController as UserTaskController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware('role:admin')->as('admin.')->group(function () {
    
        Route::resource('users', UserController::class);
        Route::resource('tasks', TaskController::class);
    });

    Route::prefix('/')->middleware('role:user')->group(function () {
    
        Route::resource('profile', ProfileController::class);
        Route::resource('tasks', UserTaskController::class);
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');