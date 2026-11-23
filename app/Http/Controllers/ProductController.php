<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk beserta pencarian dan filter status.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $categories = Category::all();

        // Data untuk 3 Card Statistik Real-Time
        $totalProducts = Product::count(); // Total seluruh produk terdaftar
        $productsLowStock = Product::whereIn('status', ['Low stock', 'Low of Stock'])->orWhere('stock', '<=', 5)->count(); // Produk stok menipis
        $activeCategory = Category::has('products')->count(); // Kategori yang memiliki relasi produk aktif

        // Query Produk dengan Filter
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                if (in_array($status, ['Low stock', 'Low of Stock'], true)) {
                    return $query->whereIn('status', ['Low stock', 'Low of Stock']);
                }
                if (in_array($status, ['Out of stock', 'Out of Stock'], true)) {
                    return $query->whereIn('status', ['Out of stock', 'Out of Stock']);
                }
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.products.index', compact(
            'products', 
            'categories', 
            'totalProducts', 
            'productsLowStock', 
            'activeCategory'
        ));
    }

    /**
     * Menyimpan data produk baru (+ Add Product).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|unique:tb_products,product_code',
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:tb_categories,id',
            'description'  => 'nullable|string',
            'buy_price'    => 'required|numeric|min:0|max:9999999999',
            'sell_price'   => 'required|numeric|min:0|max:9999999999',
            'stock'        => 'required|integer|min:0|max:999999',
            'status'       => 'nullable|in:Available,Low stock,Low of Stock,Out of stock,Out of Stock,Inden',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi ekstensi eksklusif dan batas ukuran 2MB
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Penentuan status otomatis berdasarkan stok, atau menggunakan input manual jika ada
        $status = $request->status ?? 'Available';
        if ($request->stock == 0 && $status !== 'Inden') {
            $status = 'Out of stock';
        } elseif ($request->stock > 0 && $request->stock <= 5 && $status !== 'Inden') {
            $status = 'Low stock';
        }

        Product::create([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
            'description'  => $request->description,
            'buy_price'    => $request->buy_price,
            'sell_price'   => $request->sell_price,
            'stock'        => $request->stock,
            'status'       => $status,
            'image'        => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    /**
     * Memperbarui data produk.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_code' => 'required|string|unique:tb_products,product_code,' . $product->id,
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:tb_categories,id',
            'description'  => 'nullable|string',
            'buy_price'    => 'required|numeric|min:0|max:9999999999',
            'sell_price'   => 'required|numeric|min:0|max:9999999999',
            'stock'        => 'required|integer|min:0|max:999999',
            'status'       => 'nullable|in:Available,Low stock,Low of Stock,Out of stock,Out of Stock,Inden',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Validasi ekstensi eksklusif dan batas ukuran 2MB
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Penentuan status otomatis berdasarkan stok, namun tetap menghormati status 'Inden' atau input manual
        $status = $request->status ?? $product->status;
        if ($request->stock == 0 && $status !== 'Inden') {
            $status = 'Out of stock';
        } elseif ($request->stock > 0 && $request->stock <= 5 && $status !== 'Inden') {
            $status = 'Low stock';
        }

        $product->update([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'category_id'  => $request->category_id,
            'description'  => $request->description,
            'buy_price'    => $request->buy_price,
            'sell_price'   => $request->sell_price,
            'stock'        => $request->stock,
            'status'       => $status,
            'image'        => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    /**
     * Menghapus data produk.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}