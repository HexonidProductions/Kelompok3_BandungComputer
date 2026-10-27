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