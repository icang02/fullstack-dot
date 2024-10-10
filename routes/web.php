<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/dashboard/kategori', [DashboardController::class, 'index'])->name('admin.category')->middleware('auth');
Route::get('/dashboard/produk', [DashboardController::class, 'index'])->name('admin.product')->middleware('auth');

Route::resource('/dashboard/kategori', CategoryController::class)->except('show');
Route::resource('/dashboard/produk', ProductController::class)->except('show');