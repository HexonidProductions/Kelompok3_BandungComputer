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
        $inStock = $request->boolean('in_stock');
        $sort = $request->input('sort', 'terbaru');

        // Mengambil semua kategori beserta total seluruh produknya
        $categories = Category::withCount('products')->get();

        // Query seluruh produk dari model Product agar jumlahnya selaras dengan data produk
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%");
                });
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
                return $query->where('stock', '>', 0)
                                ->where('status', '!=', 'Out of Stock');
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
            ->paginate(8)
            ->withQueryString();

        return view('produk', compact(
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