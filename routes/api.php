<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AdminAuthController::class, 'register']);
Route::post('/login', [AdminAuthController::class, 'loginApi']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::get('/users-list', [UserController::class, 'getData'])->name('list-users');
    Route::post('/logout', [AdminAuthController::class, 'logoutApi']);
});