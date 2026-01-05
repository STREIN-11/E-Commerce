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