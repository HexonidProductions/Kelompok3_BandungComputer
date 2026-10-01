<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/homepage', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('overview');
});

Route::get('/overview', function () {
    return view('overview');
});

Route::get('/categories', function () {
    return view('categories');
});

Route::get('/transactions', function () {
    return view('transactions');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/suppliers', function () {
    return view('suppliers');
});

Route::get('/daily-closing', function () {
    return view('daily-closing');
});

Route::get('/login', function () {
    return view('login');
});