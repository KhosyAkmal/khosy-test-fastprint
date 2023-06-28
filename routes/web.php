<?php

use App\Http\Controllers\ProductController;
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


Route::get('/', [ProductController::class, 'showProducts']);
Route::get('/data-api', [ProductController::class, 'getDataFromAPI']);

Route::post('/store/product',[ProductController::class, 'storeProduct'])->name('store.product');
Route::post('/update/product/{id}',[ProductController::class, 'updateProduct'])->name('update.product');
Route::delete('/delete/product',[ProductController::class, 'destroyProduct'])->name('destroy.product');

