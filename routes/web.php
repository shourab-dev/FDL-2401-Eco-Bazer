<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\CartController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');


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

//* BANNER

use App\Http\Controllers\Backend\BannerController;

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
Route::post('/cart-update', [CartController::class, 'cartUpdate'])->name('cartUpdate');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove.ajax');

Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');


// Get Cart Summary
Route::get('/cart-summary', function () {
    $cart = session('cart', []);
    $total = 0;
    foreach ($cart as $item) {
        $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
    }
    return response()->json([
        'count' => count($cart),
        'total' => number_format($total, 2)
    ]);
})->name('cart.summary');

// Get Cart Product HTML
Route::get('/cart-products', function () {
    $cart = session('cart', []);
    $html = '';

    if (!empty($cart)) {
        foreach ($cart as $index => $value) {
            $image = isset($value['image']) ? asset('storage/' . $value['image']) : asset('frontend/assets/img/default.png');
            $title = $value['title'] ?? 'No title';
            $price = $value['price'] ?? 0;
            $quantity = $value['quantity'] ?? 0;

            $html .= '
                <div class="row align-items-center product">
                    <div class="col-3">
                        <img class="img-fluid" width="100px" src="' . $image . '" alt="' . $title . '">
                    </div>
                    <div class="col-7">
                        <h6>' . $title . '</h6>
                        <p>1 kg x <span>$' . $price . '</span></p>
                        <span>Quantity: ' . $quantity . '</span>
                    </div>
                    <div class="col-2 text-end">
                        <button data-id="' . $index . '" class="text-danger delete-item" style="font-weight:600;">X</button>
                    </div>
                </div>
            ';
        }
    } else {
        $html = '
            <div class="row align-items-center product">
                <div class="col-12 text-center">
                    <h6>No Product Found</h6>
                </div>
            </div>
        ';
    }

    return response()->json(['html' => $html]);
})->name('cart.products');
