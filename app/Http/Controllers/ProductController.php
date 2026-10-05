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


        // Query Produk dengan Filter
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%")
                        ->orWhere('product_code', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.products.index', compact('products', 'categories'));
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
            'buy_price'    => 'required|numeric',
            'sell_price'   => 'required|numeric',
            'stock'        => 'required|integer',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Penentuan status otomatis berdasarkan stok (atau bisa disesuaikan)
        $status = 'Available';
        if ($request->stock == 0) {
            $status = 'Out of stock';
        } elseif ($request->stock <= 5) { // Contoh ambang batas Low stock
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

        $status = 'Available';
        if ($request->stock == 0) {
            $status = 'Out of stock';
        } elseif ($request->stock <= 5) {
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