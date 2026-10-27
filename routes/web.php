<?php

use Illuminate\Support\Facades\Route;

Route::get('/tes-login', function () {
    return view('tampilan-masuk');
})->name('login');

// Mengarahkan ke view overview.blade.php
Route::get('/overview', function () {
    return view('overview');
})->name('overview');

// Proses submit form login langsung diarahkan ke overview
Route::post('/login-process', function () {
    return redirect()->route('overview');
})->name('login.process');

Route::get('/', function () {
    return redirect('/tes-login');
});

// Route Halaman Categories
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Route Halaman Transactions
Route::get('/transactions', function () {
    return view('transactions');
})->name('transactions');

// Route Halaman Products
Route::get('/products', function () {
    return view('products');
})->name('products');

// Route Halaman Users
Route::get('/users', function () {
    return view('users');
})->name('users');

// Route Halaman Suppliers
Route::get('/suppliers', function () {
    return view('suppliers');
})->name('suppliers');

// Route Halaman Inventory Logs
Route::get('/inventory-logs', function () {
    return view('inventory-logs');
})->name('inventory.logs');

// Route Halaman Daily Closing
Route::get('/daily-closing', function () {
    return view('daily-closing');
})->name('daily.closing');