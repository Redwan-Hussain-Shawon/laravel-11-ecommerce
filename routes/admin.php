<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login');



// Admin Middleware Protected Routes
Route::prefix('admin')->middleware(IsAdmin::class)->group(function () {
    Route::get('/home', [HomeController::class, 'admin'])->name('admin.home');
    Route::get('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

    Route::controller(AdminController::class)->group(function(){
    //   Route::get('/abc','adminCheck'); demo

    });
});
