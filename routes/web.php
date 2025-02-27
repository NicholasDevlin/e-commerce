<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\Admin;


Route::get('/', function () {
    return Redirect::route('product');
});

Auth::routes();

Route::middleware([Admin::class])->group(function () {
    Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
    Route::post('/product/create', [ProductController::class, 'store'])->name('store_product');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('edit_product');
    Route::patch('/product/{product}/edit', [ProductController::class, 'update'])->name('update_product');
    Route::delete('/product/{product}', [ProductController::class, 'delete'])->name('delete_product');
    Route::post('/order/confirm/{order}', [OrderController::class, 'confirm_payment'])->name('confirm_payment');
});

//product
Route::get('/product', [ProductController::class, 'index'])->name('product');

Route::middleware(['auth'])->group(function () {
    //product
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('show_product');
    //cart
    Route::post('/cart/{product}', [CartController::class, 'create'])->name('add_to_cart');
    Route::get('/cart', [CartController::class, 'show'])->name('show_cart');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('update_cart');
    Route::delete('cart/{cart}', [CartController::class, 'delete'])->name('delete_cart');
    //order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order/{order}', [OrderController::class, 'detail'])->name('order_detail');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/pay/{order}', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');
    //profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('update_profile');
});
