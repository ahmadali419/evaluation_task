<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [Controllers\OrderController::class, 'index'])->name('order.view');
Route::prefix('product')->group(function () {
    Route::post('product-cat', [Controllers\ProductController::class, 'getProductByCategory'])->name('getProductByCat');
    Route::post('product-price', [Controllers\ProductController::class, 'getProductPrice'])->name('getProductPrice');
});
Route::prefix('order')->group(function () {
    Route::post('create', [Controllers\OrderController::class, 'generateOrder'])->name('order.create');
    Route::get('success', [Controllers\OrderController::class, 'successMessage'])->name('order.success');
});
