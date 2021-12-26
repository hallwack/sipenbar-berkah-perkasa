<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/register', [LoginController::class, 'signup'])->middleware('guest');
Route::post('/register', [LoginController::class, 'store'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('dashboard');
    });
    Route::resource('product', ProductController::class);
    Route::resource('cashier', CashierController::class);
});
