<?php

use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('homepage');


Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//* Categories
Route::middleware('auth')->prefix('/backend/categories')->name('category.')->controller(CategoryController::class)
->group(function(){
    Route::get('/{id?}', 'index')->name('index');
    Route::post('/store-or-update/{id?}', 'storeOrUpdate')->name('store');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

//* Brands
Route::middleware('auth')->prefix('/backend/brands')->name('brand.')->controller(BrandController::class)
->group(function(){
    Route::get('/{id?}', 'index')->name('index');
    Route::post('/store-or-update/{id?}', 'storeOrUpdate')->name('store');
    Route::get('/delete/{id}', 'delete')->name('delete');
});

