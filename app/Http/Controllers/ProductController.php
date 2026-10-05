<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk beserta pencarian dan filter kategori.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category_id');

        // Query Produk dengan Filter
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
            ->latest()
            ->paginate(3)
            ->withQueryString();

        // Ambil data kategori hanya untuk dropdown filter & form modal tambah
        $categories = Category::all();

        return view('dashboard.products.index', compact('products', 'categories'));
    }

    /**
     * Menyimpan data produk baru (+ Add Product).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|unique:products,product_code',
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'description'  => 'nullable|string',
            'buy_price'    => 'required|numeric',
            'sell_price'   => 'required|numeric',
            'stock'        => 'required|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $status = $request->stock > 0 ? 'Available' : 'Out of stock';

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

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Memperbarui data produk.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_code' => 'required|string|unique:products,product_code,' . $product->id,
            'product_name' => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'description'  => 'nullable|string',
            'buy_price'    => 'required|numeric',
            'sell_price'   => 'required|numeric',
            'stock'        => 'required|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $status = $request->stock > 0 ? 'Available' : 'Out of stock';

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

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
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

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}