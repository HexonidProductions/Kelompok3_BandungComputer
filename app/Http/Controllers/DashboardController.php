<?php

namespace App\Http\Controllers;

use App\Models\DailyClosing;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman Overview / Dashboard utama.
     */
    public function index()
    {
        // Ambil riwayat penutupan kasir dengan relasi admin dan pagination
        $closings = DailyClosing::with('admin')
            ->latest()
            ->paginate(8); // Menampilkan 5 data per halaman untuk overview

        return view('dashboard.overview.index', compact('closings'));
    }
}