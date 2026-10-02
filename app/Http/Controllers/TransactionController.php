<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi dengan pencarian dan filter status pembayaran (Paid/Not Paid).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Menerima status Paid / Not Paid dari dropdown UI

        $transactions = Sale::with(['admin', 'customer'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('receipt_number', 'like', "%{$search}%")
                        ->orWhereHas('customer', function ($customerQuery) use ($search) {
                        $customerQuery->where('name', 'like', "%{$search}%");
                        })
                        ->orWhereHas('admin', function ($adminQuery) use ($search) {
                        $adminQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($status, function ($query, $status) {
                // Filter hanya jika nilainya bukan 'All'
                if ($status !== 'All') {
                    return $query->where('payment_status', $status);
                }
            })
            ->latest()
            ->paginate(3)
            ->withQueryString();

        return view('dashboard.transactions.index', compact('transactions'));
    }

    /**
     * Menyimpan transaksi baru (+ Add Transaction) beserta item-itemnya ke tb_sales & tb_sale_items.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receipt_number'   => 'required|string|unique:tb_sales,receipt_number',
            'sale_type'        => 'required|in:Offline,Online',
            'customer_id'      => 'nullable|exists:tb_users,id',
            'shipping_address' => 'required|string',
            'payment_method'   => 'required|in:Cash,Bank Transfer,QRIS',
            'total_amount'     => 'required|numeric|min:0',
            'shipping_fee'     => 'required|numeric|min:0',
            'payment_status'   => 'required|in:Paid,Not Paid',
            
            // Validasi Array Item Produk
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:tb_products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Simpan ke tb_sales
            $sale = Sale::create([
                'receipt_number'   => $request->receipt_number,
                'sale_type'        => $request->sale_type,
                'admin_id'         => $request->admin_id, 
                'customer_id'      => $request->customer_id,
                'shipping_address' => $request->shipping_address,
                'payment_method'   => $request->payment_method,
                'total_amount'     => $request->total_amount,
                'shipping_fee'     => $request->shipping_fee ?? 0,
                'payment_status'   => $request->payment_status ?? 'Not Paid',
            ]);

            // 2. Simpan ke tb_sale_items & kurangi stok di tb_products
            foreach ($request->items as $item) {
                SaleItem::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);

                $product = Product::find($item['product_id']);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                    
                    if ($product->stock <= 0) {
                        $product->update(['status' => 'Out of stock']);
                    }
                }
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Menampilkan Detail Transaksi beserta Detail Item Produk.
     */
    public function show(Sale $transaction)
    {
        $transaction->load(['admin', 'customer', 'items.product']);
        return view('dashboard.transactions.show', compact('transaction'));
    }

    /**
     * Menghapus Data Transaksi.
     */
    public function destroy(Sale $transaction)
    {
        $transaction->delete(); // tb_sale_items otomatis terhapus via foreign key cascade

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}