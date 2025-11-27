<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    if (auth()->check()) {
        // Redirect based on role: owner -> users, employee -> pos
        if (auth()->user()->role === 'owner') {
            return redirect()->route('users.index');
        }

        return redirect()->route('pos.index');
    }

    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected routes: apply auth and role check
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosController;

Route::middleware(['auth', \App\Http\Middleware\CheckRole::class])->group(function () {
    // User management CRUD (owner only - enforced in middleware)
    Route::resource('users', UserController::class);

    // POS System (owners + employees)
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-to-cart/{product}', [PosController::class, 'addToCart'])->name('pos.addToCart');
    Route::delete('/pos/remove-from-cart/{productId}', [PosController::class, 'removeFromCart'])->name('pos.removeFromCart');
    Route::post('/pos/update-cart', [PosController::class, 'updateCart'])->name('pos.updateCart');
    Route::post('/pos/checkout', [PosController::class, 'checkout'])->name('pos.checkout');
    Route::get('/pos/receipt/{order}', [PosController::class, 'receipt'])->name('pos.receipt');
    Route::post('/pos/clear-cart', [PosController::class, 'clearCart'])->name('pos.clearCart');
});
