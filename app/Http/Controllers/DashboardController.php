<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\StockEntry;
use App\Models\Product;
use App\Models\DailyClosing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total Sales This Month (Bulan & Tahun Berjalan)
        $totalSalesThisMonth = Sale::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_amount');

        // Fallback jika bulan ini kosong, ambil total keseluruhan
        if ($totalSalesThisMonth == 0) {
            $totalSalesThisMonth = Sale::sum('total_amount');
        }

        // 2. Transaction Amount (Total Keseluruhan Transaksi)
        $transactionAmount = Sale::count();

        // 3. Supplier Active
        $supplierActive = StockEntry::where('status', 'Active')->count();

        // 4. Products Low On Stock
        $productsLowOnStock = Product::where('status', 'Low stock')->count();

        // 5. Tabel Daily Closings (Dibatasi 8 baris sesuai referensi desain)
        $closings = DailyClosing::with('admin')
            ->latest()
            ->paginate(8);

        return view('dashboard.overview.index', compact(
            'totalSalesThisMonth',
            'transactionAmount',
            'supplierActive',
            'productsLowOnStock',
            'closings'
        ));
    }
}