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
use Illuminate\Http\Request;

use App\Models\Product;

Route::get('/', function () {
    $latestProducts = Product::with('category')
        ->where('status', 'Available')
        ->latest()
        ->take(4)
        ->get();

    $categories = \App\Models\Category::with(['products' => function ($q) {
        $q->where('status', 'Available')->latest()->take(1);
    }])->get()->map(function ($cat) {
        $sampleProduct = $cat->products->first();
        $cat->sample_image = $sampleProduct?->image;
        return $cat;
    });

    return view('home', compact('latestProducts', 'categories'));
})->name('homepage');

Route::get('/produk', function (Request $request) {
    $search = $request->input('search');
    $category = $request->input('category');
    $priceMin = $request->input('price_min');
    $priceMax = $request->input('price_max');
    $inStock = $request->boolean('in_stock');
    $sort = $request->input('sort', 'terbaru');

    $query = Product::with('category')->where('status', 'Available');

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('product_name', 'like', "%{$search}%")
              ->orWhere('product_code', 'like', "%{$search}%");
        });
    }

    if ($category) {
        $query->where('category_id', $category);
    }

    if ($priceMin) {
        $query->where('sell_price', '>=', $priceMin);
    }

    if ($priceMax) {
        $query->where('sell_price', '<=', $priceMax);
    }

    if ($inStock) {
        $query->where('stock', '>', 0);
    }

    switch ($sort) {
        case 'harga_terendah':
            $query->orderBy('sell_price', 'asc');
            break;
        case 'harga_tertinggi':
            $query->orderBy('sell_price', 'desc');
            break;
        case 'terbaru':
        default:
            $query->latest();
            break;
    }

    $products = $query->paginate(12)->withQueryString();
    $categories = \App\Models\Category::withCount(['products' => function ($q) {
        $q->where('status', 'Available');
    }])->get();

    return view('produk', compact('products', 'categories', 'search', 'category', 'priceMin', 'priceMax', 'inStock', 'sort'));
})->name('produk');
Route::get('/tentang', fn() => view('about'))->name('about');
Route::get('/kontak', fn() => view('contact'))->name('contact');

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

Route::middleware(['auth', 'prevent-back-history', 'admin'])->group(function () {
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
});

// Profile routes accessible by both admin and customer
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Complete profile routes for Google login customers
Route::middleware(['auth'])->group(function () {
    Route::get('/complete-profile', [GoogleController::class, 'showCompleteProfile'])->name('complete.profile');
    Route::post('/complete-profile', [GoogleController::class, 'storeCompleteProfile'])->name('complete.profile.store');
});

require __DIR__.'/auth.php';
