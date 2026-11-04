<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth / Login Route
Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/login', function () {
    return view('login');
})->name('login.page');

// Dashboard / Overview Route
Route::get('/overview', function () {
    return view('overview');
})->name('overview');

// Categories Route
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

// Transactions Route
Route::get('/transactions', function () {
    return view('transactions');
})->name('transactions');

// Products Route
Route::get('/products', function () {
    return view('products');
})->name('products');

// Users Route
Route::get('/users', function () {
    return view('users');
})->name('users');

// Suppliers Route
Route::get('/suppliers', function () {
    return view('suppliers');
})->name('suppliers');

// Inventory Logs Route
Route::get('/inventory-logs', function () {
    return view('inventory-logs');
})->name('inventory-logs');

// Daily Closing Route
Route::get('/daily-closing', function () {
    return view('daily-closing');
})->name('daily-closing');

// Logout Route
Route::post('/logout', function () {
    return redirect()->route('login');
})->name('logout');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');