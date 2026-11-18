@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <h1 class="text-xl font-light font-montserrat text-slate-800 mb-2">
        Selamat Datang Kembali, Bandung Computer Admin
    </h1>

    <!-- 4 Statistic Cards (Grid 2 Kolom) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Card 1: Total Sales This Month -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Total Sales This Month</p>
                <h3 class="text-2xl font-bold text-slate-900">Rp {{ number_format($totalSalesThisMonth ?? 0, 0, ',', '.') }}</h3>
            </div>
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/ant-design_user-outlined.png') }}" alt="Total Sales Icon" class="w-6 h-6 object-contain">
            </div>
        </div>

        <!-- Card 2: Transaction Amount -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Transaction Amount</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ number_format($transactionAmount ?? 0, 0, ',', '.') }} Transaction</h3>
            </div>
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/fa7-solid_exchange-alt (3).png') }}" alt="Transaction Amount Icon" class="w-6 h-6 object-contain">
            </div>
        </div>

        <!-- Card 3: Supplier Active -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Supplier Active</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ $supplierActive ?? 0 }} Supplier</h3>
            </div>
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/fa7-solid_exchange-alt (5).png') }}" alt="Supplier Active Icon" class="w-6 h-6 object-contain">
            </div>
        </div>

        <!-- Card 4: Products Low On Stock -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Products Low On Stock</p>
                <h3 class="text-2xl font-bold text-slate-900">{{ $productsLowOnStock ?? 0 }} Item</h3>
            </div>
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/fa7-solid_exchange-alt (10).png') }}" alt="Products Low On Stock Icon" class="w-6 h-6 object-contain">
            </div>
        </div>
    </div>

    <!-- Tabel Daily Closing -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200/80">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-800">Last Closing Shift History</h3>
            <a href="{{ route('daily-closings.index') }}" class="text-xs font-bold text-slate-900 flex items-center gap-1 hover:underline">
                See All <img src="{{ asset('icons/ic_baseline-arrow-forward.png') }}" alt="Arrow Forward Icon" class="w-4 h-4 inline-block">
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
                        <th class="py-3 px-4 rounded-r-lg">Total Income</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($closings as $item)
                        <tr>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $item->shift ?? 'Shift 1' }}</td>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $item->admin->name ?? '-' }}</td>
                            <td class="py-3.5 px-4 max-w-md truncate" title="{{ $item->notes }}">{{ $item->notes ?? '-' }}</td>
                            <td class="py-3.5 px-4 font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($item->total_income, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-400">
                                No shift closing history available.
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
                    Showing {{ $closings->firstItem() }}-{{ $closings->lastItem() }} out of {{ $closings->total() }} Last Closing Shift History
                </div>
                <div>
                    {{ $closings->links('components.pagination') }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection