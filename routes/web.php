<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderTrackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//user
Route::get('/', [UserController::class, 'index']);
Route::get('/user', [UserAuthController::class, 'index'])->name('user.login');
Route::get('/about', [UserController::class, 'about']);
Route::get('/blog', [UserController::class, 'blog']);
Route::get('/contact-us', [UserController::class, 'contact']);
Route::get('/add-cart', [UserController::class, 'addcart']);
Route::get('/services', [UserController::class, 'service']);
Route::get('/shop', [UserController::class, 'shop']);
Route::get('/add-cart', [CartItemController::class, 'addcart'])->name('add.cart');
Route::post('add-cart', [CartItemController::class, 'addcart'])->name('cart.add');
Route::delete('cart/{cartItem}', [CartItemController::class, 'remove'])->name('cart.remove');
Route::put('/cart/update/{cartItem}', [CartItemController::class, 'update'])->name('cart.update');


//admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('admin.login');
    Route::post('/post-login', [AuthController::class, 'postLogin'])->name('admin.login.post');
    Route::get('/register', [AuthController::class, 'registration'])->name('admin.register');
    Route::post('/post-registration', [AuthController::class, 'postRegistration'])->name('admin.register.post');

    Route::middleware('auth')->group(function () {
        Route::get('/addproduct', [ProductController::class, 'create'])->name('add.product');
        Route::post('/products', [ProductController::class, 'store'])->name('product.store');
        Route::get('/viewproduct', [ProductController::class, 'view'])->name('view.product');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        //orders
        Route::get('/orders', [OrderController::class, 'index'])->name('view.orders');
        Route::put('/orders/status/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

        //order-track
        Route::get('/order-track', [OrderTrackController::class, 'index'])->name('order.track');

        //blog
        Route::get('/addblog', [BlogController::class, 'create'])->name('add.blog');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/viewblog', [BlogController::class, 'view'])->name('view.blog');
        Route::get('/blogs/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

        //user
        Route::get('/view-cart', [CartItemController::class, 'viewcart'])->name('view.cart');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    });
});

//userlogin
Route::prefix('user')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', [UserAuthController::class, 'index'])->name('user.login');
        Route::post('/user-post-login', [UserAuthController::class, 'postLogin'])->name('user.login.post');
        Route::get('/register', [UserAuthController::class, 'registration'])->name('user.register');
        Route::post('/post-registration', [UserAuthController::class, 'postRegistration'])->name('user.register.post');
    });
});
