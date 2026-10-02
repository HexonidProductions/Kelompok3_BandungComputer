@extends('layouts.app')

@section('content')
<div x-data="{ 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '', 
    adminName: '', 
    totalIncome: '', 
    note: '' 
}">
    <!-- Header Page -->
    <h1 class="text-xl font-light font-montserrat text-slate-800 mb-5">
        Welcome back, Bandung Computer Admin
    </h1>

    <!-- Tabel Daily Closing -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200/80">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-800">Last Closing Shift History</h3>
            <a href="{{ route('daily-closings.index') }}" class="text-xs font-bold text-slate-900 flex items-center gap-1">
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
                                <button type="button" 
                                    @click="
                                        editOpen = true; 
                                        editUrl = '{{ route('daily-closings.update', $item->id) }}';
                                        deleteUrl = '{{ route('daily-closings.destroy', $item->id) }}';
                                        adminName = '{{ $item->admin->name ?? '' }}';
                                        totalIncome = '{{ $item->total_income }}';
                                        note = '{{ $item->notes ?? '' }}';
                                    " 
                                    class="text-slate-600 hover:text-slate-900 font-bold px-2 py-1 transition-colors">
                                    •••
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">
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
                    Showing {{ $closings->firstItem() }}-{{ $closings->lastItem() }} out of {{ $closings->total() }} last closing shift history
                </div>
                <div>
                    {{ $closings->links('components.pagination') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Edit Data -->
    <div x-show="editOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
         @keydown.escape.window="editOpen = false">

        <div class="bg-white rounded-md shadow-2xl w-full max-w-lg p-6 relative" @click.away="editOpen = false">
            <h3 class="text-base font-bold text-slate-900 mb-5">Edit Data</h3>

            <!-- Form Update -->
            <form :action="editUrl" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Admin Name -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Admin Name</label>
                        <input type="text" name="admin_name" x-model="adminName" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300" placeholder="Enter admin name">
                    </div>

                    <!-- Total Income -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Total Income</label>
                        <input type="number" name="total_income" x-model="totalIncome" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                    </div>
                </div>

                <!-- Note -->
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Note</label>
                    <textarea name="notes" x-model="note" class="w-full h-[171px] border border-slate-200 rounded-lg p-3 text-xs focus:outline-none focus:ring-0 focus:border-slate-300 resize-none" placeholder="Enter note"></textarea>
                </div>

                <!-- Action Buttons: Cancel, Delete (di tengah), dan Save -->
                <div class="flex items-center justify-end gap-2.5">
                    <!-- 1. Cancel -->
                    <button type="button" @click="editOpen = false" class="w-20 h-8 flex items-center justify-center border border-[#0F172A] rounded-[5px] text-xs font-medium text-[#000000] hover:bg-[#0F172A]/5 transition-colors">
                        Cancel
                    </button>

                    <!-- 2. Delete-->
                    <button type="submit" :formaction="deleteUrl" name="_method" value="DELETE" @click="if (!confirm('Are you sure you want to delete this data?')) $event.preventDefault()" class="w-20 h-8 flex items-center justify-center border border-[#DC2626] text-[#DC2626] hover:bg-[#DC2626]/5 rounded-[5px] text-xs font-medium transition-colors">
                        Delete
                    </button>

                    <!-- 3. Save -->
                    <button type="submit" @click="if (!confirm('Are you sure you want to save these changes in this data?')) $event.preventDefault()" class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection