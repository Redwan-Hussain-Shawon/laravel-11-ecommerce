<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\ChildcategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;
use App\Models\Childcategory;

Route::get('/admin-login', [LoginController::class, 'adminLogin'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login');



// Admin Middleware Protected Routes
Route::prefix('admin')->middleware(IsAdmin::class)->group(function () {
    Route::get('/home', [HomeController::class, 'admin'])->name('admin.home');
    Route::get('/logout', [LoginController::class, 'adminLogout'])->name('admin.logout');

    Route::prefix('category')->group(function(){
        Route::get('/',[CategoryController::class,'index'])->name('category.index');
        Route::post('/store',[CategoryController::class,'store'])->name('category.store');
        Route::get('/delete/{id}',[CategoryController::class,'destroy'])->name('category.delete');
        Route::get('/edit/{id}',[CategoryController::class,'edit']);
        Route::post('/update',[CategoryController::class,'update'])->name('category.update');

    });


    
    Route::prefix('subcategory')->group(function(){
        Route::get('/',[SubcategoryController::class,'index'])->name('subcategory.index');
        Route::post('/store',[SubcategoryController::class,'store'])->name('subcategory.store');
        Route::get('/delete/{id}',[SubcategoryController::class,'destroy'])->name('subcategory.delete');
        Route::get('/edit/{id}',[SubcategoryController::class,'edit'])->name('subcategory.edit');
        Route::post('/update/{id}', [SubcategoryController::class, 'update'])->name('subcategory.update');

    });
    Route::prefix('childcategory')->group(function(){
        Route::get('/',[ChildcategoryController::class,'index'])->name('childcategory.index');
        Route::post('/store',[ChildcategoryController::class,'store'])->name('childcategory.store');
        Route::get('/delete/{id}',[ChildcategoryController::class,'destroy'])->name('childcategory.delete');
        Route::get('/edit/{id}',[ChildcategoryController::class,'edit']);
        Route::post('/update/{id}', [ChildcategoryController::class, 'update'])->name('childcategory.update');
    }); 
    
    Route::prefix('brand')->group(function(){
        Route::get('/',[BrandController::class,'index'])->name('brand.index');
        Route::post('/store',[BrandController::class,'store'])->name('brand.store');
        Route::get('/delete/{id}',[BrandController::class,'destroy'])->name('brand.delete');
        Route::get('/edit/{id}',[BrandController::class,'edit'])->name('brand.edit');
        Route::post('update',[BrandController::class,'update'])->name('brand.update');
    });
    Route::prefix('setting')->group(function(){
        Route::prefix('seo')->group(function(){
            Route::get('/',[SettingController::class,'seo'])->name('setting.seo');
            Route::post('/update',[SettingController::class,'seoUpdate'])->name('seo.setting.update');
        });
        Route::prefix('smtp')->group(function(){
            Route::get('/',[SettingController::class,'smtp'])->name('smtp.setting');
            Route::post('/update',[SettingController::class,'smtpUpdate'])->name('smtp.setting.update');
        });
        Route::prefix('page')->group(function(){
            Route::get('/',[PageController::class,'index'])->name('page.index');
            Route::post('/',[PageController::class,'store'])->name('page.store');
            Route::view('/create','admin.setting.page.create')->name('page.create');
            Route::get('/delete/{id}',[PageController::class,'destroy'])->name('page.delete');
            Route::get('/edit/{id}',[PageController::class,'edit'])->name('page.edit');
            Route::post('/update/{id}',[PageController::class,'update'])->name('page.update');
        });
      
    });


});
