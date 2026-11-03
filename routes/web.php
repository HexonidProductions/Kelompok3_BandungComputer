<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Kelompok 3 Bandung Computer
|--------------------------------------------------------------------------
*/

// Landing Page & Login Page
Route::get('/', function () {
    return view('login');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

// Route Logout
Route::match(['get', 'post'], '/logout', function () {
    return redirect()->route('login');
})->name('logout');

// Halaman Modul
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/overview', function () {
    return view('overview');
})->name('overview');

Route::get('/categories', function () {
    return view('categories');
})->name('categories');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/suppliers', function () {
    return view('suppliers');
})->name('suppliers');

Route::get('/transactions', function () {
    return view('transactions');
})->name('transactions');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/daily-closing', function () {
    return view('daily-closing');
})->name('daily-closing');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');