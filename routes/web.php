<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DailyClosingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryLogController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

// Halaman login (otomatis redirect jika sudah login sesuai role)
Route::get('/login', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }
        return redirect()->route('homepage');
    }
    return view('auth.login');
})->name('login');

// Login Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/homepage', [UserController::class, 'index'])->name('home');
    Route::resource('/daily-closings', DailyClosingController::class);
    Route::resource('/categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('/products', ProductController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/inventory-logs', InventoryLogController::class);
    Route::resource('/transactions', TransactionController::class);
    Route::resource('/users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
