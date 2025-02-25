<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create_product'])->name('create_product');
Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::post('/store_product', [App\Http\Controllers\ProductController::class, 'store'])->name('store_product');
