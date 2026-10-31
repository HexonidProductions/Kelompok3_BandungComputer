<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\StockEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type   = $request->input('type'); // Menangkap parameter filter type (in / out / return)

        $logs = InventoryLog::with(['product', 'supplier'])
            ->when($search, function ($query, $search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%");
                });
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $products = Product::all();
        $suppliers = StockEntry::all();

        return view('dashboard.inventory_logs.index', compact('logs', 'products', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'    => 'required|exists:tb_products,id',
            'supplier_id'   => 'nullable|exists:tb_stock_entries,id',
            'type'          => 'required|in:in,out,return',
            'customer_name' => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'notes'         => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            // 1. Simpan data inventory log
            InventoryLog::create($request->all());

            // 2. Jika tipenya 'return', STOK TIDAK DIUBAH SAMA SEKALI
            if ($request->type !== 'return') {
                $product = Product::lockForUpdate()->findOrFail($request->product_id);

                if ($request->type === 'in') {
                    $product->stock += $request->quantity;
                } else {
                    $product->stock -= $request->quantity;
                    if ($product->stock < 0) {
                        $product->stock = 0;
                    }
                }

                // UPDATE STATUS OTOMATIS BERDASARKAN JUMLAH STOK
                if ($product->stock == 0) {
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
        });

        return redirect()->back()->with('success', 'Inventory log added successfully!');
    }

    public function update(Request $request, InventoryLog $inventoryLog)
    {
        $request->validate([
            'product_id'    => 'required|exists:tb_products,id',
            'supplier_id'   => 'nullable|exists:tb_stock_entries,id',
            'type'          => 'required|in:in,out,return',
            'customer_name' => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'notes'         => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $inventoryLog) {
            // 1. REVERSI/KEMBALIKAN STOK LAMA 
            // Hanya lakukan reversi jika log lama adalah 'in'. 
            // Jika log lama 'out', diabaikan agar stok tidak 'balik kanan' saat diubah ke return/out lainnya.
            if ($inventoryLog->type === 'in') {
                $oldProduct = Product::lockForUpdate()->findOrFail($inventoryLog->product_id);
                $oldProduct->stock -= $inventoryLog->quantity;
                if ($oldProduct->stock < 0) {
                    $oldProduct->stock = 0;
                }
                $oldProduct->save();
            }

            // 2. TERAPKAN STOK BARU 
            if ($request->type === 'in') {
                $newProduct = Product::lockForUpdate()->findOrFail($request->product_id);
                $newProduct->stock += $request->quantity;

                if ($newProduct->stock == 0) {
                    $newProduct->status = 'Out of stock';
                } elseif ($newProduct->stock <= 5) {
                    $newProduct->status = 'Low stock';
                } else {
                    if ($newProduct->status !== 'Inden') {
                        $newProduct->status = 'Available';
                    }
                }
                $newProduct->save();
            } elseif ($request->type === 'out' && $inventoryLog->type !== 'out') {
                $newProduct = Product::lockForUpdate()->findOrFail($request->product_id);
                $newProduct->stock -= $request->quantity;
                if ($newProduct->stock < 0) {
                    $newProduct->stock = 0;
                }

                if ($newProduct->stock == 0) {
                    $newProduct->status = 'Out of stock';
                } elseif ($newProduct->stock <= 5) {
                    $newProduct->status = 'Low stock';
                } else {
                    if ($newProduct->status !== 'Inden') {
                        $newProduct->status = 'Available';
                    }
                }
                $newProduct->save();
            }
            // Jika tipe baru adalah 'return', tidak ada perubahan stok sama sekali.

            // 3. UPDATE DATA LOG ITU SENDIRI
            $inventoryLog->update([
                'product_id'    => $request->product_id,
                'supplier_id'   => $request->supplier_id,
                'type'          => $request->type,
                'customer_name' => $request->customer_name,
                'quantity'      => $request->quantity,
                'notes'         => $request->notes,
            ]);
        });

        return redirect()->route('inventory-logs.index')->with('success', 'Inventory log updated successfully!');
    }

    public function destroy(InventoryLog $inventoryLog)
    {
        DB::transaction(function () use ($inventoryLog) {
            // Jika log yang dihapus bertipe 'in', kembalikan efek stoknya ke produk
            if ($inventoryLog->type === 'in') {
                $product = Product::lockForUpdate()->findOrFail($inventoryLog->product_id);
                $product->stock -= $inventoryLog->quantity;
                if ($product->stock < 0) {
                    $product->stock = 0;
                }

                if ($product->stock == 0) {
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
            // Jika log yang dihapus bertipe 'out' atau 'return', stok tidak diubah/dikembalikan

            $inventoryLog->delete();
        });

        return redirect()->back()->with('success', 'Inventory log deleted successfully!');
    }
}