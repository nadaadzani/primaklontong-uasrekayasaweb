<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\AdminProductController;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/products',[ProductsController::class,'index'])->name('products');
Route::get('/products/${id}',[ProductsController::class,'show'])->name('products.show');

Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('admin.dashboard');

    Route::get('/product/pdf', [AdminProductController::class, 'cetakPdf'])->name('products.pdf');
    Route::resource('products', AdminProductController::class);

    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
});