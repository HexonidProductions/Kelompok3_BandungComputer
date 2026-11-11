<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    /**
     * Menampilkan halaman katalog produk untuk publik / customer.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        $inStock = $request->input('in_stock');
        $sort = $request->input('sort', 'terbaru');

        // Mengambil semua kategori beserta jumlah produknya (menggunakan relasi 'products' dari model Category)
        $categories = Category::withCount('products')->get();

        // Query produk dari model Product (yang sudah terhubung ke tabel tb_products)
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('product_name', 'like', "%{$search}%")
                             ->orWhere('product_code', 'like', "%{$search}%");
            })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->when($priceMin, function ($query, $priceMin) {
                return $query->where('sell_price', '>=', $priceMin);
            })
            ->when($priceMax, function ($query, $priceMax) {
                return $query->where('sell_price', '<=', $priceMax);
            })
            ->when($inStock, function ($query) {
                // Sesuai migration, produk tersedia jika stok > 0 atau status Available
                return $query->where('stock', '>', 0);
            })
            ->when($sort, function ($query, $sort) {
                if ($sort === 'harga_terendah') {
                    return $query->orderBy('sell_price', 'asc');
                } elseif ($sort === 'harga_tertinggi') {
                    return $query->orderBy('sell_price', 'desc');
                } else {
                    return $query->latest();
                }
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(8) // Menampilkan 8 produk per halaman (sesuai grid 4x2)
            ->withQueryString();

        return view('produk.index', compact(
            'products', 
            'categories', 
            'search', 
            'categoryId', 
            'priceMin', 
            'priceMax', 
            'inStock', 
            'sort'
        ));
    }
}