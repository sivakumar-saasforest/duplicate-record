<?php

use App\Livewire\Home;
use App\Livewire\Product;
use App\Livewire\ProductFaqView;
use Illuminate\Support\Facades\Route;
use RzqApplication\Plugin\Store\Store;
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

Route::get('/', Home::class);
Route::get('/product-fqz', Product::class)->name('product-fqz')->middleware('rzq-auth');
Route::get('/product-fqz-edit/{id}', ProductFaqView::class)->name('product-fqz-edit')->middleware('rzq-auth');