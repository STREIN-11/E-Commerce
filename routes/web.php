<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('register', [AdminAuthController::class, 'showRegister'])->name('admin.register');
    Route::post('register', [AdminAuthController::class, 'register']);
    
    Route::middleware('admin')->group(function () {
        Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
        
        Route::resource('products', ProductController::class)->names([
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]);
        
        Route::get('products-import', [ProductController::class, 'showImport'])->name('admin.products.import');
        Route::post('products-import', [ProductController::class, 'import']);
        Route::post('user-offline', [AdminAuthController::class, 'setUserOffline']);
    });
});

// Customer Routes
Route::prefix('customer')->group(function () {
    Route::get('login', [CustomerAuthController::class, 'showLogin'])->name('customer.login');
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::get('register', [CustomerAuthController::class, 'showRegister'])->name('customer.register');
    Route::post('register', [CustomerAuthController::class, 'register']);
    
    Route::middleware('customer')->group(function () {
        Route::get('dashboard', [CustomerAuthController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('product/{product}', [CustomerAuthController::class, 'showProduct'])->name('customer.product.show');
        Route::post('logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    });
});