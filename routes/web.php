<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/products');

Route::resource('products', ProductController::class)->except(['show']);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
