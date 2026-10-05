@extends('layouts.app')

@section('content')
<div class="space-y-6" x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '',
    selectedSupplier: {} 
}">

    <!-- Header & Action Bar -->
    <div class="space-y-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-medium text-slate-900">Supplier</h1>

        <!-- Search Bar, Status Filter & Add Supplier Button -->
        <div class="flex flex-wrap justify-between items-center gap-4">
            <!-- Container Kiri: Search & Status Filter -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search Form -->
                <form action="{{ route('suppliers.index') }}" method="GET" class="relative w-72">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{ asset('icons/ci_search-magnifying-glass.png') }}" alt="Search" class="w-4 h-4">
                    </div>
                    <input type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search supplier" 
                        class="w-full h-9 pl-9 pr-3 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-600 focus:outline-none focus:ring-0 focus:border-slate-300">
                </form>

                <!-- Supplier Status Custom Dropdown (Fixed Box + Animasi Dua Arah) -->
                <div x-data="{ open: false }" class="relative inline-block text-left min-w-[160px]" @click.away="open = false">
                    <!-- Tombol Utama (Ukuran Fix h-9) -->
                    <button type="button" 
                        @click="open = !open" 
                        class="w-full h-9 inline-flex items-center justify-between gap-3 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white px-3.5 focus:outline-none focus:border-slate-300 shadow-sm cursor-pointer">
                        <span>
                            @if(request('status') == 'Active')
                                Status: Active
                            @elseif(request('status') == 'Not Active')
                                Status: Not Active
                            @else
                                Status: All
                            @endif
                        </span>
                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                            alt="Arrow" 
                            class="w-2.5 h-2.5 object-contain"
                            :class="open ? 'rotate-180' : 'rotate-0'">
                    </button>

                    <!-- Kotak Opsi Menyatu yang Melayang Fix -->
                    <div x-show="open" 
                        x-cloak
                        class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                        
                        <!-- Header tiruan di dalam box dengan animasi putar balik -->
                        <div @click="open = !open" class="h-9 flex items-center justify-between px-3.5 cursor-pointer">
                            <span>
                                @if(request('status') == 'Active')
                                    Status: Active
                                @elseif(request('status') == 'Not Active')
                                    Status: Not Active
                                @else
                                    Status: All
                                @endif
                            </span>
                            <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                alt="Arrow" 
                                class="w-2.5 h-2.5 object-contain"
                                :class="open ? 'rotate-180' : 'rotate-0'">
                        </div>

                        <!-- Daftar Pilihan -->
                        <div class="py-1 border-slate-100">
                            <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" 
                                class="block px-3.5 py-2.5 transition-colors {{ request('status') == '' ? 'font-semibold' : null }}">
                                Status: All
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'Active']) }}" 
                                class="block px-3.5 py-2.5 transition-colors {{ request('status') == 'Active' ? 'font-semibold' : null }}">
                                Status: Active
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'Not Active']) }}" 
                                class="block px-3.5 py-2.5 transition-colors {{ request('status') == 'Not Active' ? 'font-semibold' : null }}">
                                Status: Not Active
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Supplier Button (Tinggi h-9 agar sejajar sempurna) -->
            <button type="button" 
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all cursor-pointer">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add Supplier" class="w-4 h-4 object-contain"> Add Supplier
            </button>   
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Supplier List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-3 rounded-l-lg">Entry Code</th>
                        <th class="py-3 px-3">Supplier Name</th>
                        <th class="py-3 px-3">Contact</th>
                        <th class="py-3 px-3">Address</th>
                        <th class="py-3 px-3 text-center">Status</th>
                        <th class="py-3 px-3 rounded-r-lg text-center w-16">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td class="py-3.5 px-3 font-bold text-slate-900 whitespace-nowrap">{{ $supplier->entry_code }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-900">{{ $supplier->supplier_name }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-600">{{ $supplier->phone_number }}</td>
                            <td class="py-3.5 px-3 text-slate-700 max-w-[200px] truncate leading-relaxed text-[11px]" title="{{ $supplier->address }}">{{ $supplier->address }}</td>
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                @if($supplier->status === 'Active')
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#16A34A] text-[#000000] bg-white">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#DC2626] text-[#000000] bg-white">
                                        Not Active
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-center">
                                <button type="button" 
                                    @click="
                                        editUrl = '{{ route('suppliers.update', $supplier->id) }}';
                                        deleteUrl = '{{ route('suppliers.destroy', $supplier->id) }}';
                                        selectedSupplier = {{ json_encode($supplier) }};
                                        editOpen = true;
                                    "
                                    class="inline-flex items-center justify-center p-1 rounded-lg transition-all cursor-pointer"
                                    title="Supplier Options">
                                    <img src="{{ asset('icons/3_dots_icon.png') }}" alt="Options" class="w-4 h-4 object-contain">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-slate-400">No suppliers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($suppliers->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>Showing {{ $suppliers->firstItem() }}-{{ $suppliers->lastItem() }} out of {{ $suppliers->total() }} Suppliers</div>
                <div>{{ $suppliers->links('components.pagination') }}</div>
            </div>
        @endif
    </div>


    <!-- ================= MODAL ADD SUPPLIER ================= -->
    <template x-teleport="body">
        <div x-show="createOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="createOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Add New Supplier</h3>
                </div>

                <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Entry Code</label>
                            <input type="text" name="entry_code" required placeholder="Enter entry code" value="{{ old('entry_code') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Supplier Name</label>
                            <input type="text" name="supplier_name" required placeholder="Enter supplier name" value="{{ old('supplier_name') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Contact</label>
                            <input type="text" name="phone_number" required placeholder="Enter contact" value="{{ old('phone_number') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Address</label>
                            <input type="text" name="address" required placeholder="Enter address" value="{{ old('address') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Status Dropdown Add Modal (Fix Box + Animasi Dua Arah) -->
                        <div x-data="{ createStatusOpen: false, createStatusValue: '', createStatusName: 'Select status' }" class="relative md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Status</label>
                            <input type="hidden" name="status" x-model="createStatusValue" required>
                            
                            <div class="relative" @click.away="createStatusOpen = false">
                                <button type="button" 
                                    @click="createStatusOpen = !createStatusOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span :class="createStatusValue ? 'text-slate-700' : 'text-slate-400'" x-text="createStatusName"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="createStatusOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="createStatusOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="createStatusOpen = !createStatusOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span :class="createStatusValue ? 'text-slate-700' : 'text-slate-400'" x-text="createStatusName"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="createStatusOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        <div @click="createStatusValue = 'Active'; createStatusName = 'Active'; createStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="createStatusValue == 'Active' ? 'font-semibold' : null">Active</div>
                                        <div @click="createStatusValue = 'Not Active'; createStatusName = 'Not Active'; createStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="createStatusValue == 'Not Active' ? 'font-semibold' : null">Not Active</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="createOpen = false" class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">Cancel</button>
                        <button type="submit" class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm cursor-pointer">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>


    <!-- ================= MODAL EDIT SUPPLIER ================= -->
    <template x-teleport="body">
        <div x-show="editOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="editOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Edit Supplier</h3>
                </div>

                <form :action="editUrl" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Entry Code</label>
                            <input type="text" name="entry_code" x-model="selectedSupplier.entry_code" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Supplier Name</label>
                            <input type="text" name="supplier_name" x-model="selectedSupplier.supplier_name" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Contact</label>
                            <input type="text" name="phone_number" x-model="selectedSupplier.phone_number" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Address</label>
                            <input type="text" name="address" x-model="selectedSupplier.address" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Status Dropdown Edit Modal (Fix Box + Animasi Dua Arah) -->
                        <div x-data="{ editStatusOpen: false }" class="relative md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Status</label>
                            <input type="hidden" name="status" x-model="selectedSupplier.status" required>
                            
                            <div class="relative" @click.away="editStatusOpen = false">
                                <button type="button" 
                                    @click="editStatusOpen = !editStatusOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span class="text-slate-700" x-text="selectedSupplier.status || 'Select status'"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editStatusOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="editStatusOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="editStatusOpen = !editStatusOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="selectedSupplier.status || 'Select status'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editStatusOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        <div @click="selectedSupplier.status = 'Active'; editStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedSupplier.status == 'Active' ? 'font-semibold' : null">Active</div>
                                        <div @click="selectedSupplier.status = 'Not Active'; editStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedSupplier.status == 'Not Active' ? 'font-semibold' : null">Not Active</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="editOpen = false" class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">Cancel</button>
                        <button type="button" @click="
                            if(confirm('Are you sure you want to delete this supplier?')) {
                                $refs.globalDeleteForm.action = deleteUrl;
                                $refs.globalDeleteForm.submit();
                            }
                        " class="w-20 h-8 flex items-center justify-center border border-[#DC2626] text-[#DC2626] hover:bg-[#DC2626]/5 rounded-[5px] text-xs font-medium transition-colors cursor-pointer">Delete</button>
                        <button type="submit" class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm cursor-pointer">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <form x-ref="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>
@endsection