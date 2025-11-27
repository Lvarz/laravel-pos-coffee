<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('users.index');
    }

    return view('auth.login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User management CRUD
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class);
