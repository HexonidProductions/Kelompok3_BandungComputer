@extends('layouts.app')

@section('content')
    <!-- Margin top dihilangkan/dipack ringkas agar naik ke atas -->
    <h1 class="text-xl font-light font-montserrat text-slate-800 mb-5">
        Welcome back, Bandung Computer Admin
    </h1>

    <!-- Tabel Daily Closing -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200/80">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-800">Last Closing Shift History</h3>
            <a href="{{ route('daily-closings.index') }}" class="text-xs font-bold text-slate-900 hover:underline flex items-center gap-1">
                See All <img src="{{ asset('icons/ic_baseline-arrow-forward.png')}}" alt="Arrow Forward Icon" class="w-4 h-4 inline-block">
            </a>
        </div>

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
                        <tr>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $item->shift }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $item->admin->name ?? '-' }}</td>
                            <td class="py-3.5 px-4 max-w-xs truncate">{{ $item->notes ?? '-' }}</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($item->total_income, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <button class="text-slate-600 hover:text-slate-900 font-bold px-2 py-1">•••</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
                                Belum ada riwayat penutupan shift.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Footer & Pagination -->
            @if($closings->count() > 0)
                <div class="flex items-center justify-between mt-6 text-xs text-slate-800">
                    <div>
                        Showing {{ $closings->firstItem() }}-{{ $closings->lastItem() }} out of {{ $closings->total() }} last closing shift history
                    </div>
                    <div>
                        {{ $closings->links('components.pagination') }}
                    </div>
                </div>
            @endif
    </div>
@endsection