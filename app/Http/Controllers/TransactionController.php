<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi dengan pencarian dan filter status pembayaran.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search'));
        $status = $request->input('status'); 

        $transactions = Sale::with(['admin', 'customer', 'items.product'])
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    // Cari berdasarkan nomor resi
                    $q->where('receipt_number', 'LIKE', '%' . $search . '%')
                      // Cari berdasarkan nama customer
                      ->orWhereHas('customer', function ($customerQuery) use ($search) {
                          $customerQuery->where('name', 'LIKE', '%' . $search . '%');
                      })
                      // Cari berdasarkan nama cashier/admin
                      ->orWhereHas('admin', function ($adminQuery) use ($search) {
                          $adminQuery->where('name', 'LIKE', '%' . $search . '%');
                      });
                });
            })
            ->when($status, function ($query, $status) {
    // Bersihkan input status dari Blade (ubah ke huruf kecil & trim)
    $cleanStatus = strtolower(trim($status));

    // Cocokkan secara case-insensitive dengan database
    return $query->whereRaw('LOWER(TRIM(payment_status)) = ?', [$cleanStatus]);
})
            
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $admins = User::whereIn('role', ['admin', 'cashier'])->get();
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();

        return view('dashboard.transactions.index', compact('transactions', 'admins', 'customers', 'products'));
    }

    /**
     * Menyimpan transaksi baru (+ Add Transaction) beserta item-itemnya.
     */
    public function store(Request $request)
    {
        if (is_string($request->items)) {
            $request->merge(['items' => json_decode($request->items, true)]);
        }

        $request->validate([
            'receipt_number'   => 'required|string|unique:tb_sales,receipt_number',
            'sale_type'        => 'required|in:Offline,Online',
            'admin_id'         => 'nullable|exists:tb_users,id',
            'customer_id'      => 'nullable|exists:tb_users,id',
            'shipping_address' => 'nullable|string',
            'payment_method'   => 'required|in:Cash,Bank Transfer,QRIS',
            'total_amount'     => 'required|numeric|min:0',
            'shipping_fee'     => 'required|numeric|min:0',
            'payment_status'   => 'required|in:paid,not paid',
            'items'            => 'nullable|array',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $sale = Sale::create([
                    'receipt_number'   => $request->receipt_number,
                    'sale_type'        => $request->sale_type,
                    'admin_id'         => $request->admin_id ?? auth()->id(), 
                    'customer_id'      => $request->customer_id,
                    'shipping_address' => $request->shipping_address,
                    'payment_method'   => $request->payment_method,
                    'total_amount'     => $request->total_amount,
                    'shipping_fee'     => $request->shipping_fee ?? 0,
                    'payment_status'   => $request->payment_status ?? 'not paid',
                ]);

                if (!empty($request->items)) {
                    foreach ($request->items as $item) {
                        $productId = $item['product_id'] ?? null;
                        $productName = $item['product_name'] ?? $item['name'] ?? null;
                        $quantity = (int) ($item['quantity'] ?? 1);
                        $product = null;

                        if ($productId) {
                            $product = Product::find($productId);
                        } elseif ($productName) {
                            $product = Product::where('product_name', $productName)->first();
                        }

                        // Validasi stok pada level server
                        if ($product) {
                            if ($product->stock < $quantity) {
                                throw new Exception("Stok untuk produk '{$product->product_name}' tidak mencukupi (Sisa stok: {$product->stock}).");
                            }

                            // Potong stok produk
                            $product->decrement('stock', $quantity);
                            if ($product->stock <= 0) {
                                $product->update(['status' => 'Out of stock']);
                            }
                            $productId = $product->id;
                        }

                        SaleItem::create([
                            'sale_id'    => $sale->id,
                            'product_id' => $productId,
                            'quantity'   => $quantity,
                            'unit_price' => $item['price'] ?? $item['unit_price'] ?? 0,
                        ]);
                    }
                }
            });
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Menampilkan Detail Transaksi.
     */
    public function show(Sale $transaction)
    {
        $transaction->load(['admin', 'customer', 'items.product']);
        return view('dashboard.transactions.show', compact('transaction'));
    }

    /**
     * Memperbarui Data Transaksi (Update / Edit).
     */
    public function update(Request $request, Sale $transaction)
    {
        if (is_string($request->items)) {
            $request->merge(['items' => json_decode($request->items, true)]);
        }

        $request->validate([
            'sale_type'        => 'required|in:Offline,Online',
            'shipping_address' => 'nullable|string',
            'payment_method'   => 'required|in:Cash,Bank Transfer,QRIS',
            'total_amount'     => 'required|numeric|min:0',
            'shipping_fee'     => 'required|numeric|min:0',
            'payment_status'   => 'required|in:paid,not paid',
            'items'            => 'nullable|array',
        ]);

        try {
            DB::transaction(function () use ($request, $transaction) {
                // Restore stok item transaksi lama sebelum diperbarui
                foreach ($transaction->items as $oldItem) {
                    if ($oldItem->product_id) {
                        $product = Product::find($oldItem->product_id);
                        if ($product) {
                            $product->increment('stock', $oldItem->quantity);
                            if ($product->stock > 0 && $product->status === 'Out of stock') {
                                $product->update(['status' => 'In stock']);
                            }
                        }
                    }
                }

                // Hapus item lama
                $transaction->items()->delete();

                // Update data utama transaksi
                $transaction->update([
                    'sale_type'        => $request->sale_type,
                    'shipping_address' => $request->shipping_address,
                    'payment_method'   => $request->payment_method,
                    'total_amount'     => $request->total_amount,
                    'shipping_fee'     => $request->shipping_fee,
                    'payment_status'   => $request->payment_status,
                ]);

                // Simpan item baru dan potong stok kembali
                if (!empty($request->items)) {
                    foreach ($request->items as $item) {
                        $productId = $item['product_id'] ?? null;
                        $productName = $item['product_name'] ?? $item['name'] ?? null;
                        $quantity = (int) ($item['quantity'] ?? 1);
                        $product = null;

                        if ($productId) {
                            $product = Product::find($productId);
                        } elseif ($productName) {
                            $product = Product::where('product_name', $productName)->first();
                        }

                        if ($product) {
                            if ($product->stock < $quantity) {
                                throw new Exception("Stok untuk produk '{$product->product_name}' tidak mencukupi (Sisa stok: {$product->stock}).");
                            }

                            $product->decrement('stock', $quantity);
                            if ($product->stock <= 0) {
                                $product->update(['status' => 'Out of stock']);
                            }
                            $productId = $product->id;
                        }

                        SaleItem::create([
                            'sale_id'    => $transaction->id,
                            'product_id' => $productId,
                            'quantity'   => $quantity,
                            'unit_price' => $item['price'] ?? $item['unit_price'] ?? 0,
                        ]);
                    }
                }
            });
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Menghapus Data Transaksi.
     */
    public function destroy(Sale $transaction)
    {
        DB::transaction(function () use ($transaction) {
            // Restore stok produk saat transaksi dihapus
            foreach ($transaction->items as $item) {
                if ($item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->increment('stock', $item->quantity);
                        if ($product->stock > 0 && $product->status === 'Out of stock') {
                            $product->update(['status' => 'In stock']);
                        }
                    }
                }
            }
            $transaction->delete();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}