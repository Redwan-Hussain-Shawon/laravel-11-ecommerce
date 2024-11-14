<?php

use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\frontend\UserController;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/user',[UserController::class,'index']);
Route::resource('users',UserController::class);

Route::prefix('auth')->middleware(RedirectIfAuthenticated::class)->group((function(){
   Route::view('signup','frontend.auth.signup');
   Route::view('signin','frontend.auth.signin')->name('signin');
   Route::post('registerSave',[UserController::class,'register'])->name('registerSave');
   Route::post('loginmatch',[UserController::class,'login'])->name('loginmatch');
}));

Route::prefix('dashboard')->middleware(ValidUser::class)->group((function(){
    Route::view('/','frontend.dashboard.index')->name('dashboard');
    Route::get('/profile/{id}',[UserController::class,'profile'])
         ->where('id', '[0-9]+')        
         ->name('user.profile');
    Route::get('logout',[UserController::class,'logout'])->name('logout');
 }));


 Route::get('/pdf', [HomeController::class, 'pdfGenerate']);
