<?php

namespace App\Http\Controllers;

use App\Models\DailyClosing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyClosingController extends Controller
{
    /**
     * Menampilkan daftar riwayat penutupan kasir.
     */
    public function index()
    {
        // Nama admin yang sedang login untuk teks "Today's Shift: Nama"
        $currentAdminName = Auth::user()->name;

        // Fetch data beserta relasi admin (Eager Loading)
        $closings = DailyClosing::with('admin')
            ->latest()
            ->paginate(5);

        return view('dashboard.daily_closings.index', compact('currentAdminName', 'closings'));
    }

    /**
     * Menyimpan data penutupan kasir baru (+ Add History).
     */
    public function store(Request $request)
    {
        $request->validate([
            'total_income' => 'required|numeric|min:0',
            'notes'        => 'nullable|string',
        ]);

        $user = \aPP\Models\User::where('name', $request->admin_name)->first();
        $adminId = $user ? $user->id : Auth::id(); // Jika admin_name tidak ditemukan, gunakan ID admin yang login
        DailyClosing::create([
            'admin_id'     => $adminId,
            'total_income' => $request->total_income,
            'notes'        => $request->notes,
        ]);

        // DIPERBAIKI: Menggunakan nama route yang benar (daily-closings.index)
        return redirect()->route('daily-closings.index')->with('success', 'Daily closing added successfully!');
    }

    /**
     * Memperbarui data penutupan kasir (Edit/Update Data).
     */
    public function update(Request $request, DailyClosing $dailyClosing)
{
    $request->validate([
        'total_income' => 'required|numeric|min:0',
        'notes'        => 'nullable|string',
        'admin_name'   => 'nullable|string|max:255',
    ]);

    // 1. Update data Daily Closing
    $dailyClosing->update([
        'total_income' => $request->total_income,
        'notes'        => $request->notes,
    ]);

    // 2. Update nama admin jika diisi & relasinya ada
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