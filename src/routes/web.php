<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('/products', [ProductController::class,'index'])->name('products.index');
Route::get('/products/search', [ProductController::class, 'search']);

Route::get('/products/register/index', [ProductController::class, 'registerIndex'])->name('products.register-index');
Route::post('/products/register', [ProductController::class, 'store'])->name('products.register');

Route::get('/products/detail/{productId}',[ProductController::class, 'show'])->name('products.show');
Route::patch('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.delete');
