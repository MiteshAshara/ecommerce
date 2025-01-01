<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//user
Route::get('/', [UserController::class, 'index']);
Route::get('/about', [UserController::class, 'about']);
Route::get('/blog', [UserController::class, 'blog']);
Route::get('/contact-us', [UserController::class, 'contact']);
Route::get('/services', [UserController::class, 'service']);
Route::get('/shop', [UserController::class, 'shop']);


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
    });
});
