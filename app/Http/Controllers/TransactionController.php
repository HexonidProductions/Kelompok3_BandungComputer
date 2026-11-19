<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;
use App\Models\User;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

        // Data untuk 3 Card Statistik Real-Time Transactions
        $totalSalesThisMonth = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        $transactionAmount = Sale::count();

        $averageTransaction = Sale::avg('total_amount') ?? 0;

        $transactions = Sale::with(['admin', 'items.product'])
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('receipt_number', 'LIKE', '%' . $search . '%')
                        ->orWhere('customer_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('note', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('admin', function ($adminQuery) use ($search) {
                            $adminQuery->where('name', 'LIKE', '%' . $search . '%');
                        });
                });
            })
            ->when($status, function ($query, $status) {
                $cleanStatus = strtolower(trim($status));
                return $query->whereRaw('LOWER(TRIM(payment_status)) = ?', [$cleanStatus]);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $admins = User::whereIn('role', ['admin', 'cashier'])->get();
        $products = Product::all();

        return view('dashboard.transactions.index', compact(
            'transactions', 
            'admins', 
            'products', 
            'totalSalesThisMonth', 
            'transactionAmount', 
            'averageTransaction'
        ));
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
            'customer_name'    => 'nullable|string|max:255',
            'note'             => 'nullable|required_if:payment_status,inden|string|max:2000',
            'shipping_address' => 'nullable|string',
            'payment_method'   => 'required|in:Cash,Bank Transfer,QRIS',
            'total_amount'     => 'required|numeric|min:0|max:9999999999',
            'shipping_fee'     => 'required|numeric|min:0|max:9999999999',
            'payment_status'   => 'required|in:paid,not paid,inden',
            'items'            => 'nullable|array',
        ], [
            'note.required_if' => 'Keterangan identitas pembeli dan rincian DP wajib diisi jika status transaksi adalah Inden.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $customerNameInput = $request->customer_name ?: 'Guest / Umum';
                $isPaid = strtolower(trim($request->payment_status)) === 'paid';

                $sale = Sale::create([
                    'receipt_number'   => $request->receipt_number,
                    'sale_type'        => $request->sale_type,
                    'admin_id'         => $request->admin_id ?? Auth::id(),
                    'customer_name'    => $customerNameInput,
                    'note'             => $request->note,
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

                        if ($product) {
                            $productId = $product->id;

                            // Validasi & potong stok HANYA jika status pembayaran sudah 'paid'
                            if ($isPaid) {
                                if ($product->stock < $quantity) {
                                    throw new Exception("Stok untuk produk '{$product->product_name}' tidak mencukupi (Sisa stok: {$product->stock}).");
                                }

                                $product->stock -= $quantity;
                                if ($product->stock <= 0) {
                                    $product->stock = 0;
                                    $product->status = 'Out of stock';
                                } elseif ($product->stock <= 5) {
                                    $product->status = 'Low stock';
                                }
                                $product->save();
                            }
                        }

                        SaleItem::create([
                            'sale_id'    => $sale->id,
                            'product_id' => $productId,
                            'quantity'   => $quantity,
                            'unit_price' => $item['price'] ?? $item['unit_price'] ?? 0,
                        ]);

                        // Catat ke Inventory Logs (tipe out) HANYA jika status transaksi sudah 'paid'
                        if ($productId && $isPaid) {
                            InventoryLog::create([
                                'product_id'    => $productId,
                                'supplier_id'   => null,
                                'type'          => 'out',
                                'quantity'      => $quantity,
                                'customer_name' => $customerNameInput,
                                'notes'         => 'Penjualan No. Resi: ' . $sale->receipt_number,
                            ]);
                        }
                    }
                }
            });
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully!');
    }

    /**
     * Menampilkan Detail Transaksi.
     */
    public function show(Sale $transaction)
    {
        $transaction->load(['admin', 'items.product']);
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
            'admin_id'         => 'nullable|exists:tb_users,id',
            'customer_name'    => 'nullable|string|max:255',
            'note'             => 'nullable|required_if:payment_status,inden|string|max:2000',
            'shipping_address' => 'nullable|string',
            'payment_method'   => 'required|in:Cash,Bank Transfer,QRIS',
            'total_amount'     => 'required|numeric|min:0|max:9999999999',
            'shipping_fee'     => 'required|numeric|min:0|max:9999999999',
            'payment_status'   => 'required|in:paid,not paid,inden',
            'items'            => 'nullable|array',
        ], [
            'note.required_if' => 'Keterangan identitas pembeli dan rincian DP wajib diisi jika status transaksi adalah Inden.',
        ]);

        try {
            DB::transaction(function () use ($request, $transaction) {
                $wasPaid = strtolower(trim($transaction->payment_status)) === 'paid';
                $isNowPaid = strtolower(trim($request->payment_status)) === 'paid';

                // 1. Restore stok item transaksi lama HANYA jika transaksi sebelumnya berstatus 'paid'
                if ($wasPaid) {
                    foreach ($transaction->items as $oldItem) {
                        if ($oldItem->product_id) {
                            $product = Product::find($oldItem->product_id);
                            if ($product) {
                                $product->stock += $oldItem->quantity;
                                if ($product->stock <= 0) {
                                    $product->status = 'Out of stock';
                                } elseif ($product->stock <= 5) {
                                    $product->status = 'Low stock';
                                } else {
                                    if ($product->status !== 'Inden') {
                                        $product->status = 'Available';
                                    }
                                }
                                $product->save();
                            }
                        }
                    }
                }

                // Hapus item lama dari database sale_items
                $transaction->items()->delete();

                // 2. Hapus Inventory Log lama yang mencatat nomor resi ini
                InventoryLog::where('notes', 'LIKE', '%' . $transaction->receipt_number . '%')->delete();

                $customerNameInput = $request->customer_name ?: 'Guest / Umum';

                // Update data utama transaksi
                $transaction->update([
                    'sale_type'        => $request->sale_type,
                    'admin_id'         => $request->admin_id ?? $transaction->admin_id,
                    'customer_name'    => $customerNameInput,
                    'note'             => $request->note,
                    'shipping_address' => $request->shipping_address,
                    'payment_method'   => $request->payment_method,
                    'total_amount'     => $request->total_amount,
                    'shipping_fee'     => $request->shipping_fee,
                    'payment_status'   => $request->payment_status,
                ]);

                // 3. Simpan item baru, potong stok & buat inventory log HANYA jika status baru adalah 'paid'
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
                            $productId = $product->id;

                            if ($isNowPaid) {
                                if ($product->stock < $quantity) {
                                    throw new Exception("Stok untuk produk '{$product->product_name}' tidak mencukupi (Sisa stok: {$product->stock}).");
                                }

                                $product->stock -= $quantity;
                                if ($product->stock <= 0) {
                                    $product->stock = 0;
                                    $product->status = 'Out of stock';
                                } elseif ($product->stock <= 5) {
                                    $product->status = 'Low stock';
                                }
                                $product->save();
                            }
                        }

                        SaleItem::create([
                            'sale_id'    => $transaction->id,
                            'product_id' => $productId,
                            'quantity'   => $quantity,
                            'unit_price' => $item['price'] ?? $item['unit_price'] ?? 0,
                        ]);

                        if ($productId && $isNowPaid) {
                            InventoryLog::create([
                                'product_id'    => $productId,
                                'supplier_id'   => null,
                                'type'          => 'out',
                                'quantity'      => $quantity,
                                'customer_name' => $customerNameInput,
                                'notes'         => 'Penjualan No. Resi: ' . $transaction->receipt_number,
                            ]);
                        }
                    }
                }
            });
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi updated successfully!');
    }

    /**
     * Menghapus Data Transaksi tanpa mengembalikan stok produk.
     */
    public function destroy(Sale $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $transaction->items()->delete();
            $transaction->delete();
        });

        return redirect()->route('transactions.index')->with('success', 'Transaksi deleted successfully!');
    }
}