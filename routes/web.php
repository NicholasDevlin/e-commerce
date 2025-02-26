<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//product
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/create', [ProductController::class, 'create'])->name('create_product');
Route::post('/product/create', [ProductController::class, 'store'])->name('store_product');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('show_product');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('edit_product');
Route::patch('/product/{product}/edit', [ProductController::class, 'update'])->name('update_product');
Route::delete('/product/{product}', [ProductController::class, 'delete'])->name('delete_product');

Route::post('/cart/{product}', [CartController::class, 'create'])->name('add_to_cart');
Route::get('/cart', [CartController::class, 'show'])->name('show_cart');
Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('update_cart');
Route::delete('cart/{cart}', [CartController::class, 'delete'])->name('delete_cart');
