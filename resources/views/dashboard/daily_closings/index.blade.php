@extends('layouts.app')

@section('content')
<div x-data="{ 
    editOpen: false, 
    createOpen: false, 
    editUrl: '', 
    deleteUrl: '', 
    adminName: '', 
    totalIncome: '', 
    note: '' 
}" class="space-y-6">

    <!-- Header Utama -->
    <div class="space-y-4">
        <!-- Judul Halaman -->
        <h1 class="text-2xl font-medium">Daily Closing</h1>

        <!-- Baris Sub-Header: Today's Shift & Tombol Add History -->
        <div class="flex justify-between items-center">
            <!-- Teks Today's Shift -->
            <p class="text-slate-600 text-xs font-medium">
                Today's Shift: <span class="text-slate-900 font-semibold">{{ $currentAdminName ?? auth()->user()->name }}</span>
            </p>

            <!-- Tombol Add History (Membuka Modal Input) -->
            <button type="button" 
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1.5 rounded-lg shadow-sm transition-all">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add Icon" class="w-3.5 h-3.5">
                Add History
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <!-- Table Title -->
        <div class="mb-4">
            <h3 class="text-lg font-bold text-slate-800">Last Closing Shift History</h3>
        </div>

        <!-- Responsive Table -->
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
                            <td class="py-4 px-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">{{ $item->shift }}</td>
                            <td class="py-4 px-4 whitespace-nowrap">{{ $item->admin->name ?? '-' }}</td>
                            <td class="py-4 px-4 max-w-xs truncate">{{ $item->notes ?? '-' }}</td>
                            <td class="py-4 px-4 font-bold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($item->total_income, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <button 
                                    type="button"
                                    @click="
                                        editUrl = '{{ route('daily-closings.update', $item->id) }}';
                                        deleteUrl = '{{ route('daily-closings.destroy', $item->id) }}';
                                        adminName = '{{ $item->admin->name ?? '' }}';
                                        totalIncome = '{{ $item->total_income }}';
                                        note = '{{ addslashes($item->notes ?? '') }}';
                                        editOpen = true;
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

    <!-- Modal Add History Data -->
    <div x-show="createOpen" 
        x-cloak 
        class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
        @keydown.escape.window="createOpen = false">

        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 relative" @click.away="createOpen = false">
            <h3 class="text-base font-bold text-slate-900 mb-5">Add Daily Closing History</h3>

            <form action="{{ route('daily-closings.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Admin Name-->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Admin Name</label>
                        <input type="text"
                            name="admin_name"
                            value="{{ auth()->user()->name }}"
                            required 
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300">
                    </div>

                    <!-- Total Income -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Total Income</label>
                        <input type="number" 
                            name="total_income" 
                            required 
                            min="0"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" 
                            placeholder="Rp 0">
                    </div>
                </div>

                <!-- Note -->
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Note</label>
                    <textarea name="notes" 
                        class="w-full h-[171px] border border-slate-200 rounded-lg p-3 text-xs focus:outline-none focus:ring-0 focus:border-slate-300 resize-none" 
                        placeholder="Enter note"></textarea>
                </div>

                <!-- Action Buttons: Cancel | Save -->
                <div class="flex items-center justify-end gap-2.5">
                    <button type="button" 
                        @click="createOpen = false" 
                        class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>

                    <button type="submit" 
                        @click="if (!confirm('Are you sure you want to add this history?')) $event.preventDefault()" 
                        class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Data -->
    <div x-show="editOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
         @keydown.escape.window="editOpen = false">

        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 relative" @click.away="editOpen = false">
            <h3 class="text-base font-bold text-slate-900 mb-5">Edit Data</h3>

            <!-- Hidden Form for Delete Action -->
            <form x-ref="deleteForm" :action="deleteUrl" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>

            <!-- Main Update Form -->
            <form :action="editUrl" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Admin Name (Readonly) -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Admin Name</label>
                        <input type="text" 
                            x-model="adminName" 
                            readonly
                            class="w-full border border-slate-200 bg-slate-100 rounded-lg px-3 py-2 text-xs cursor-not-allowed focus:outline-none focus:ring-0 focus:border-slate-300"
                            placeholder="Enter admin name">
                    </div>

                    <!-- Total Income -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Total Income</label>
                        <input type="number" 
                            name="total_income" 
                            x-model="totalIncome" 
                            required 
                            min="0"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" 
                            placeholder="Rp 0">
                    </div>
                </div>

                <!-- Note -->
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Note</label>
                    <textarea name="notes" 
                        x-model="note" 
                        class="w-full h-[171px] border border-slate-200 rounded-lg p-3 text-xs focus:outline-none focus:ring-0 focus:border-slate-300 resize-none" 
                        placeholder="Enter note"></textarea>
                </div>

                <!-- Action Buttons: Cancel | Delete | Save -->
                <div class="flex items-center justify-end gap-2.5">
                    <!-- Cancel -->
                    <button type="button" 
                        @click="editOpen = false" 
                        class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                        Cancel
                    </button>

                    <!-- Delete Button -->
                    <button type="button" 
                        @click="if (confirm('Are you sure you want to delete this data?')) $refs.deleteForm.submit()" 
                        class="w-20 h-8 flex items-center justify-center border border-[#DC2626] text-[#DC2626] hover:bg-[#DC2626]/5 rounded-[5px] text-xs font-medium transition-colors">
                        Delete
                    </button>

                    <!-- Save Button -->
                    <button type="submit" 
                        @click="if (!confirm('Are you sure you want to save these changes?')) $event.preventDefault()" 
                        class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection