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

        DailyClosing::create([
            'admin_id'     => Auth::id(), // Otomatis terisi ID admin yang login
            'total_income' => $request->total_income,
            'notes'        => $request->notes,
        ]);

        return redirect()->route('daily_closings.index')->with('success', 'Daily closing berhasil ditambahkan!');
    }

    /**
     * Menghapus riwayat penutupan kasir.
     */
    public function destroy(DailyClosing $dailyClosing)
    {
        $dailyClosing->delete();

        return redirect()->route('daily_closings.index')->with('success', 'Data berhasil dihapus!');
    }
}