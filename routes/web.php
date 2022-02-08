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


Route::prefix('order')->group(function () {
    Route::get('/', [Controllers\OrderController::class, 'index'])->name('order.view');
});
Route::prefix('product')->group(function () {
    Route::post('get-product-by-cat', [Controllers\ProductController::class, 'getProductByCategory'])->name('getProductByCat');
});
