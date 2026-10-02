<!-- Container Utama (Tombol + Tabel) -->
<div class="space-y-6">

    <!-- Tombol Add History di Atas Kanan -->
    <div class="flex justify-between items-center">
        <div>
            <!-- Teks Today's Shift -->
            <p class="text-slate-600 text-sm font-medium">
                Today's Shift: <span class="text-slate-900 font-semibold">{{ auth()->user()->name ?? 'Alif Hassan Abdillah' }}</span>
            </p>
        </div>
        <div>
            <a href="{{ route('daily_closings.create') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Add History
            </a>
        </div>
    </div>

    <!-- Card Tabel Daily Closing -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <!-- Title Tabel -->
        <div class="mb-4">
            <h3 class="text-lg font-bold text-slate-800">Last Closing Shift History</h3>
        </div>

        <!-- Tabel Responsive -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-4 rounded-l-lg">Date</th>
                        <th class="py-3 px-4">Shift</th>
                        <th class="py-3 px-4">Cashier</th>
                        <th class="py-3 px-4">Note</th>
                        <th class="py-3 px-4">Income</th>
                        <th class="py-3 px-4 rounded-r-lg text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($closings as $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">{{ $item->shift }}</td>
                            <td class="py-4 px-4 whitespace-nowrap">{{ $item->user->name ?? $item->cashier_name }}</td>
                            <td class="py-4 px-4 max-w-xs truncate">{{ $item->note ?? '-' }}</td>
                            <td class="py-4 px-4 font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($item->income, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <button class="text-slate-600 hover:text-slate-900 font-bold px-2 py-1">•••</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                Belum ada data riwayat penutupan shift.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer & Pagination -->
        @if($closings->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>
                    Menampilkan {{ $closings->firstItem() }}-{{ $closings->lastItem() }} dari {{ $closings->total() }} Last Closing Shift History
                </div>
                <div>
                    {{ $closings->links() }}
                </div>
            </div>
        @endif
    </div>

</div>