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
        $type   = $request->input('type'); // Menangkap parameter filter type (in / out)

        $logs = InventoryLog::with(['product', 'supplier'])
            ->when($search, function ($query, $search) {
                $query->whereHas('product', function ($q) use ($search) {
                    $q->where('product_name', 'like', "%{$search}%");
                });
            })
            ->when($type, function ($query, $type) {
                $query->where('type', $type); // Filter berdasarkan tipe log (in / out)
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
            'type'          => 'required|in:in,out',
            'customer_name' => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'notes'         => 'nullable|string|max:255',
        ]);

        // 1. Simpan data inventory log
        InventoryLog::create($request->all());

        // 2. Ambil produk yang dipilih
        $product = Product::findOrFail($request->product_id);

        // 3. Update stok berdasarkan tipe (in / out)
        if ($request->type === 'in') {
            $product->stock += $request->quantity;
        } else {
            $product->stock -= $request->quantity;
            if ($product->stock < 0) {
                $product->stock = 0;
            }
        }

        // 4. UPDATE STATUS OTOMATIS BERDASARKAN JUMLAH STOK
        if ($product->stock == 0) {
            $product->status = 'Out of stock';
        } elseif ($product->stock <= 5) { // Anda bisa sesuaikan batas "Low stock" (misal <= 5)
            $product->status = 'Low stock';
        } else {
            $product->status = 'Available';
        }

        // 5. Simpan perubahan ke database
        $product->save();

        return redirect()->back()->with('success', 'Inventory log berhasil ditambahkan dan status produk diperbarui!');
    }

    public function update(Request $request, InventoryLog $inventoryLog)
    {
        $request->validate([
            'product_id'    => 'required|exists:tb_products,id',
            'supplier_id'   => 'nullable|exists:tb_stock_entries,id',
            'type'          => 'required|in:in,out',
            'customer_name' => 'nullable|string|max:255',
            'quantity'      => 'required|integer|min:1',
            'notes'         => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $inventoryLog) {
            $oldProduct = Product::lockForUpdate()->findOrFail($inventoryLog->product_id);
            if ($inventoryLog->type === 'in') {
                $oldProduct->stock - $inventoryLog->quantity;
            } else {
                $oldProduct->stock + $inventoryLog->quantity;
            }
            if ($oldProduct->stock < 0) {
                $oldProduct->stock = 0;
            }
            $oldProduct->save();

            // 2. TERAPKAN STOK BARU BERDASARKAN DATA REQUEST YANG DIINPUT
            $newProduct = Product::lockForUpdate()->findOrFail($request->product_id);
            if ($request->type === 'in') {
                $newProduct->stock += $request->quantity;
            } else {
                $newProduct->stock -= $request->quantity;
            }
            if ($newProduct->stock < 0) {
                $newProduct->stock = 0;
            }

            // 3. UPDATE STATUS OTOMATIS
            if ($newProduct->stock == 0) {
                $newProduct->status = 'Out of stock';
            } elseif ($newProduct->stock <= 5) {
                $newProduct->status = 'Low stock';
            } else {
                $newProduct->status = 'Available';
            }
            $newProduct->save();

            // 4. UPDATE DATA LOG ITU SENDIRI
            // Gunakan update biasa, pastikan tidak ada double assignment
            $inventoryLog->update([
                'product_id'    => $request->product_id,
                'supplier_id'   => $request->supplier_id,
                'type'          => $request->type,
                'customer_name' => $request->customer_name,
                'quantity'      => $request->quantity,
                'notes'         => $request->notes,
            ]);
        });

        return redirect()->route('inventory-logs.index')->with('success', 'Inventory log dan stok berhasil diperbarui!');
    }

    public function destroy(InventoryLog $inventoryLog)
    {
        DB::transaction(function () use ($inventoryLog) {
            // Kembalikan stok produk saat log dihapus
            $product = Product::lockForUpdate()->findOrFail($inventoryLog->product_id);
            
            if ($inventoryLog->type === 'in') {
                $product->stock -= $inventoryLog->quantity;
                if ($product->stock < 0) {
                    $product->stock = 0;
                }
            } else {
                $product->stock += $inventoryLog->quantity;
            }
            $product->save();

            // Hapus log
            $inventoryLog->delete();
        });

        return redirect()->back()->with('success', 'Inventory log deleted successfully!');
    }
}