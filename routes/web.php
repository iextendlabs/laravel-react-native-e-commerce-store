<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [FrontendController::class, 'home']);

Route::middleware('guest')->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store_register']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'store_login']);
});

Route::middleware('auth')->group(function () {    
    Route::get('admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'destroy']);

    // category
    Route::resource('categories', CategoryController::class)->parameters([
        'categories' =>  'category:slug',
    ]);
    // product
    Route::resource('products', ProductController::class)->parameters([
        'products' =>  'product:slug',
    ]);
    // product images
    Route::resource('product-images', ProductImageController::class);
    
    // order
    Route::get('orders', [OrderController::class, 'index'])->name('orders');
    Route::get('orders-edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('orders-update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('orders-destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::get('my-order', [CheckoutController::class, 'my_orders']);
    Route::get('order-detail/{id}', [CheckoutController::class, 'order_detail'])->name('order.detail');
});

 // checkout
Route::get('cart', [CheckoutController::class, 'cart']);
Route::get('add-to-cart/{id}', [CheckoutController::class, 'add_to_cart'])->name('add.to.cart');
Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('quantity-update/{id}', [CheckoutController::class, 'quantity'])->name('quantity.update');
Route::get('place-order', [CheckoutController::class, 'place_order'])->name('place.order');
Route::get('remove/{id}', [CheckoutController::class, 'remove'])->name('remove');
Route::get('category-product/{slug}', [FrontendController::class, 'categories_product'])->name('category');
Route::get('product-detail/{product}', [FrontendController::class, 'product_detail'])->name('product.detail');
Route::get('buy_now/{product}', [CheckoutController::class, 'buy_now'])->name('buy.now');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__.'/auth.php';