<?php

namespace App\Http\Controllers;

use App\Models\StockEntry;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar supplier dengan pencarian dan filter status (Active/Inactive).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Menerima filter status dari dropdown UI

        $stockentry = StockEntry::when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('entry_code', 'like', "%{$search}%")
                        ->orWhere('supplier_name', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%");
                });
            })
            ->when($status, function ($query, $status) {
                // Filter hanya berlaku jika nilai bukan 'All'
                if ($status !== 'All') {
                    return $query->where('status', $status);
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.suppliers.index', compact('stockentry'));
    }

    /**
     * Menyimpan data supplier baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'entry_code'         => 'required|string|unique:tb_stock_entry,entry_code',
            'supplier_name'      => 'required|string|max:255',
            'phone_number'       => 'required|string|max:20',
            'address'            => 'required|string',
            'status'             => 'required|in:Active,Not Active',
        ]);

        StockEntry::create([
            'entry_code'         => $request->entry_code,
            'supplier_name'      => $request->supplier_name,
            'phone_number'       => $request->phone_number,
            'address'            => $request->address,
            'status'             => $request->status,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    /**
     * Memperbarui data supplier.
     */
    public function update(Request $request, StockEntry $stockentry)
    {
        $request->validate([
            'entry_code'         => 'required|string|unique:tb_stock_entry,entry_code,' . $stockentry->id,
            'supplier_name'      => 'required|string|max:255',
            'phone_number'       => 'required|string|max:20',
            'address'            => 'required|string',
            'status'             => 'required|in:Active,Not Active',
        ]);

        $stockentry->update([
            'entry_code'         => $request->entry_code,
            'supplier_name'      => $request->supplier_name,
            'phone_number'       => $request->phone_number,
            'address'            => $request->address,
            'status'             => $request->status,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui!');
    }

    /**
     * Menghapus data supplier.
     */
    public function destroy(StockEntry $stockentry)
    {
        $stockentry->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus!');
    }
}