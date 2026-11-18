<?php

namespace App\Http\Controllers;

use App\Models\DailyClosing;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyClosingController extends Controller
{
    /**
     * Menampilkan daftar riwayat penutupan kasir beserta ringkasan pendapatan.
     */
    public function index()
    {
        // Nama admin yang sedang login untuk teks "Today's Shift: Nama"
        $currentAdminName = Auth::user()->name;

        // 1. Hitung Akumulasi Total Income dari DailyClosing
        $totalIncome = DailyClosing::sum('total_income');

        // 2. Hitung Rincian Nominal & Jumlah Transaksi per Metode Pembayaran dari tabel Sales
        $incomeCash  = Sale::whereRaw('LOWER(TRIM(payment_method)) = ?', ['cash'])->sum('total_amount');
        $countCash   = Sale::whereRaw('LOWER(TRIM(payment_method)) = ?', ['cash'])->count();

        $incomeDebit = Sale::whereRaw('LOWER(TRIM(payment_method)) IN (?, ?)', ['bank transfer', 'debit'])->sum('total_amount');
        $countDebit  = Sale::whereRaw('LOWER(TRIM(payment_method)) IN (?, ?)', ['bank transfer', 'debit'])->count();

        $incomeQris  = Sale::whereRaw('LOWER(TRIM(payment_method)) = ?', ['qris'])->sum('total_amount');
        $countQris   = Sale::whereRaw('LOWER(TRIM(payment_method)) = ?', ['qris'])->count();

        // Fetch data beserta relasi admin (Eager Loading)
        $closings = DailyClosing::with('admin')
            ->latest()
            ->paginate(5);

        return view('dashboard.daily_closings.index', compact(
            'currentAdminName', 
            'closings', 
            'totalIncome', 
            'incomeCash', 
            'countCash',
            'incomeDebit', 
            'countDebit',
            'incomeQris',
            'countQris'
        ));
    }

    /**
     * Menyimpan data penutupan kasir baru (+ Add History).
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_income' => 'required|numeric|min:0|max:9999999999',
            'notes'        => 'nullable|string',
        ]);

        $user = \App\Models\User::where('name', $request->admin_name)->first();
        $adminId = $user ? $user->id : Auth::id(); 

        DailyClosing::create([
            'admin_id'     => $adminId,
            'total_income' => $request->total_income,
            'notes'        => $request->notes,
        ]);

        return redirect()->route('daily-closings.index')->with('success', 'Daily closing added successfully!');
    }

    /**
     * Memperbarui data penutupan kasir (Edit/Update Data).
     */
    public function update(Request $request, DailyClosing $dailyClosing)
    {
        $request->validate([
            'total_income' => 'required|numeric|min:0|max:9999999999',
            'notes'        => 'nullable|string',
            'admin_name'   => 'nullable|string|max:255',
        ]);

        $dailyClosing->update([
            'total_income' => $request->total_income,
            'notes'        => $request->notes,
        ]);

        if ($request->filled('admin_name') && $dailyClosing->admin) {
            $dailyClosing->admin->update([
                'name' => $request->admin_name,
            ]);
        }

        return redirect()->back()->with('success', 'Data daily closing updated successfully!');
    }

    /**
     * Menghapus riwayat penutupan kasir.
     */
    public function destroy(DailyClosing $dailyClosing)
    {
        $dailyClosing->delete();

        return redirect()->back()->with('success', 'Data deleted successfully!');
    }
}