<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;


Route::get('/', [HomeController::class, 'index'])->name('homepage');


Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Contact-Us
Route::controller(ContactController::class)->group(function(){
    Route::get('/contact', 'index')->name('contact');
    Route::post('/storeContact', 'storeContact')->name('storeContact');
    Route::get('/contact/message', 'contactMessage')->name('contactMessage');
    Route::get('/contact/delete/{id?}', 'contactDelete')->name('contactDelete');

});


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


//* Products
Route::middleware('auth')
->prefix('backend/products')
->name('products.')
->controller(ProductController::class)
->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/show/{id}', 'show')->name('show');
    Route::get('create', 'create')->name('create');
    Route::post('store/{id?}', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::post('/live-categories', 'liveCategory')->name('live.category');
});