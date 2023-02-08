<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', HomeController::class)->name('home');

Route::get('/category/{category:name}', [CategoryController::class, 'show']);

Route::resource('products', ProductController::class)->parameters(['products' => 'product:slug']);

Route::get('/profile', ProfileController::class)->name('profile');

Route::resource('/cart', CartController::class)->only('index', 'update', 'store');

Route::get('/history', HistoryController::class)->name('history');

Auth::routes();
