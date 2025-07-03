<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\CustomerProfileController;
use App\Http\Controllers\Auth\CustomerRegisterController;


Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/category/{slug}', [HomeController::class, 'getCategoryProducts'])->name('frontend.categories.products');
Route::get('/product/{slug}', [HomeController::class, 'singleProduct'])->name('frontend.single_products');
Route::get('/live-search', [HomeController::class, 'searchProduct'])->name('frontend.live_search');
Route::get('/search', [HomeController::class, 'search'])->name('frontend.search');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('cart.checkout');



Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);




//* Customer Route
Route::name('customer.')->group(function () {
    Route::get('/sign-in', [CustomerLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/sign-in', [CustomerLoginController::class, 'login'])->name('login.req');
    Route::get('/sign-up', [CustomerRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/sign-up', [CustomerRegisterController::class, 'register'])->name('register.req');
    Route::get('/my-profile', [CustomerProfileController::class, 'myProfile'])->name('profile');
    Route::get('/google/login', [CustomerLoginController::class, 'googleLogin'])->name('google.login');
    Route::get('/google/redirect', [CustomerLoginController::class, 'googleRedirect'])->name('google.redirect');
    Route::get('/facebook/login', [CustomerLoginController::class, 'facebookLogin'])->name('facebook.login');
    Route::get('/facebook/redirect', [CustomerLoginController::class, 'facebookRedirect'])->name('facebook.redirect');
});





Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//* Categories
Route::middleware('auth')->prefix('/backend/categories')->name('category.')->controller(CategoryController::class)
    ->group(function () {
        Route::get('/{id?}', 'index')->name('index');
        Route::post('/store-or-update/{id?}', 'storeOrUpdate')->name('store');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });

//* Brands
Route::middleware('auth')->prefix('/backend/brands')->name('brand.')->controller(BrandController::class)
    ->group(function () {
        Route::get('/{id?}', 'index')->name('index')->middleware('can:show-brand');
        Route::post('/store-or-update/{id?}', 'storeOrUpdate')->name('store')->middleware('can:create-brand,edit-brand');
        Route::get('/delete/{id}', 'delete')->name('delete')->middleware('can:delete-brandx');
    });


//* Products
Route::middleware('auth')
    ->prefix('backend/products')
    ->name('products.')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('store/{id?}', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/live-categories', 'liveCategory')->name('live.category');
    });

//* BANNER




Route::middleware('auth')->prefix('/backend/banners')->name('banner.')->controller(BannerController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
    Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggle.status');
});


//* Add to cart
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart-summary', [CartController::class, 'summary'])->name('cart.summary');
Route::post('/cart-update', [CartController::class, 'cartUpdate'])->name('cartUpdate');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove.ajax');
