<?php

use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'], function() {
    
    // Guest middleware
    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', [LoginController::class,'index'])->name('account.login');
        Route::get('register', [LoginController::class,'register'])->name('account.register');
        Route::post('process-register', [LoginController::class,'processRegister'])->name('account.processRegister');
        Route::post('authenticate', [LoginController::class,'authenticate'])->name('account.authenticate');
    });

    // Auth middleware
    Route::group(['middleware' => 'auth'], function() {
        Route::get('logout', [LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class,'index'])->name('account.dashboard');
        Route::get('/', PostController::class .'@index')->name('posts.index');
        Route::get('/posts/create', PostController::class . '@create')->name('posts.create');
        Route::post('/posts', PostController::class .'@store')->name('posts.store');
        Route::get('/posts/{post}', PostController::class .'@show')->name('posts.show');
        Route::get('/posts/{post}/edit', PostController::class .'@edit')->name('posts.edit');
        Route::put('/posts/{post}', PostController::class .'@update')->name('posts.update');
        Route::delete('/posts/{post}', PostController::class .'@destroy')->name('posts.destroy');
    });
});

Route::group(['prefix' => 'admin'], function() {
    
    // Guest middleware for admin
    Route::group(['middleware' => 'admin.guest'], function() {
        Route::get('login', [AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class,'authenticate'])->name('admin.authenticate');    
    });

    // Auth middleware for admin
    Route::group(['middleware' => 'admin.auth'], function() {
        Route::get('dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class,'logout'])->name('admin.logout');
    });
});









