<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi dengan pencarian dan filter status pembayaran.
     */
    public function index(Request $request)
    {
        $search =$request->input('search');
        $status =$request->input('status'); 

        $transactions = Sale::with(['admin', 'customer', 'items.product'])
            ->when($search, function ($query,$search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('receipt_number', 'like', "\%{$search}%")
                        ->orWhereHas('customer', function ($customerQuery) use ($search) {
                            $customerQuery->where('name', 'like', "\%{$search}%");
                        })
                        ->orWhereHas('admin', function ($adminQuery) use ($search) {
                            $adminQuery->where('name', 'like', "\%{$search}%");
                        });
                });
            })
            ->when($status, function ($query,$status) {
                if ($status === 'paid') {
                    return $query->where('payment_status', 'Paid');
                } elseif ($status === 'not paid') {
                    return $query->where('payment_status', 'Not Paid');
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Mengambil data user berdasarkan role masing-masing
        // Catatan: Ubah string 'admin' / 'customer' sesuai dengan value role di database Anda
        $admins = User::whereIn('role', ['admin', 'cashier'])->get();$customers = User::where('role', 'customer')->get();

        return view('dashboard.transactions.index', compact('transactions', 'admins', 'customers'));
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
            'payment_status'   => 'required|in:Paid,Not Paid',
            'items'            => 'nullable|array',
        ]);

        DB::transaction(function () use ($request) {$sale = Sale::create([
                'receipt_number'   => $request->receipt_number,
                'sale_type'        => $request->sale_type,
                'admin_id'         => $request->admin_id ?? auth()->id(), 
                'customer_id'      => $request->customer_id,
                'shipping_address' => $request->shipping_address,
                'payment_method'   => $request->payment_method,
                'total_amount'     => $request->total_amount,
                'shipping_fee'     => $request->shipping_fee ?? 0,
                'payment_status'   => $request->payment_status ?? 'Not Paid',
            ]);

            if (!empty($request->items)) {
                foreach ($request->items as$item) {
                    $productId =$item['product_id'] ?? null;
                    $productName = $item['product_name'] ?? $item['name'] ?? null;
                    $product = null;

                    // Cari atau buat produk berdasarkan kolom `product_name`
                    if ($productId) {
                        $product = Product::find($productId);
                    } elseif ($productName) {$product = Product::firstOrCreate(
                            ['product_name' => $productName],
                            [
                                'price'  => $item['price'] ?? $item['unit_price'] ?? 0,
                                'stock'  => 0,
                                'status' => 'Out of stock',
                            ]
                        );
                        $productId =$product->id;
                    }

                    SaleItem::create([
                        'sale_id'    => $sale->id,
                        'product_id' => $productId,
                        'quantity'   => $item['quantity'] ?? 1,
                        'unit_price' => $item['price'] ?? $item['unit_price'] ?? 0,
                    ]);

                    // Potong stok jika produk ditemukan dan stok memadai
                    if ($product &&$product->stock > 0) {
                        $product->decrement('stock',$item['quantity'] ?? 1);
                        if ($product->stock <= 0) {$product->update(['status' => 'Out of stock']);
                        }
                    }
                }
            }
        });

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
    public function update(Request $request, Sale$transaction)
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
            'payment_status'   => 'required|in:Paid,Not Paid',
            'items'            => 'nullable|array',
        ]);

        DB::transaction(function () use ($request, $transaction) {$transaction->update([
                'sale_type'        => $request->sale_type,
                'shipping_address' => $request->shipping_address,
                'payment_method'   => $request->payment_method,
                'total_amount'     => $request->total_amount,
                'shipping_fee'     => $request->shipping_fee,
                'payment_status'   => $request->payment_status,
            ]);

            if ($request->has('items')) {$transaction->items()->delete();

                foreach ($request->items as$item) {
                    $productId =$item['product_id'] ?? null;
                    $productName = $item['product_name'] ?? $item['name'] ?? null;

                    if (!$productId && $productName) {$product = Product::firstOrCreate(
                            ['product_name' => $productName],
                            [
                                'price'  => $item['price'] ?? $item['unit_price'] ?? 0,
                                'stock'  => 0,
                                'status' => 'Out of stock',
                            ]
                        );
                        $productId =$product->id;
                    }

                    SaleItem::create([
                        'sale_id'    => $transaction->id,
                        'product_id' => $productId,
                        'quantity'   => $item['quantity'] ?? 1,
                        'unit_price' => $item['price'] ?? $item['unit_price'] ?? 0,
                    ]);
                }
            }
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Menghapus Data Transaksi.
     */
    public function destroy(Sale $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}