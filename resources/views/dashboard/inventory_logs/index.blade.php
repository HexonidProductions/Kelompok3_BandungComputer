@extends('layouts.app')

@section('content')
<div class="space-y-6" x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '',
    selectedLog: {} 
}">

    <!-- Header & Action Bar -->
    <div class="space-y-4">
        <h1 class="text-2xl font-medium text-slate-900">Inventory Log</h1>

        <div class="flex flex-wrap justify-between items-center gap-4">
            <!-- Search Form -->
            <form action="{{ route('inventory-logs.index') }}" method="GET" class="relative w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <img src="{{ asset('icons/ci_search-magnifying-glass.png') }}" alt="Search" class="w-4 h-4">
                </div>
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search product name" 
                    class="w-full h-9 pl-9 pr-3 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-600 focus:outline-none focus:ring-0 focus:border-slate-300">
            </form>

            <!-- Add Log Button -->
            <button type="button" 
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all cursor-pointer">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add Log" class="w-4 h-4 object-contain"> Add Inventory Log
            </button>   
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Inventory Movement History List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-3 rounded-l-lg">Date</th>
                        <th class="py-3 px-3">Product Name</th>
                        <th class="py-3 px-3 text-center">Type</th>
                        <th class="py-3 px-3">Supplier</th>
                        <th class="py-3 px-3 text-center">Quantity</th>
                        <th class="py-3 px-3">Notes</th>
                        <th class="py-3 px-3 rounded-r-lg text-center w-16">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($logs as $log)
                        <tr>
                            <td class="py-3.5 px-4 whitespace-nowrap">{{ $log->created_at->format('d M Y') }}</td>
                            <td class="py-3.5 px-3 font-bold text-slate-900 whitespace-nowrap">{{ $log->product->product_name ?? '-' }}</td>
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                                @if($log->type === 'in')
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#16A34A] text-[#000000] bg-white uppercase">
                                        IN
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#DC2626] text-[#000000] bg-white uppercase">
                                        OUT
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 text-slate-600 whitespace-nowrap">{{ $log->supplier->supplier_name ?? '-' }}</td>
                            <td class="py-3.5 px-3 text-center font-bold text-slate-900">{{ $log->quantity }}</td>
                            <td class="py-3.5 px-3 text-slate-600 max-w-[200px] truncate" title="{{ $log->notes }}">{{ $log->notes ?? '-' }}</td>
                            <td class="py-3.5 px-3 text-center">
                                <button type="button" 
                                    @click="
                                        editUrl = '{{ route('inventory-logs.update', $log->id) }}';
                                        deleteUrl = '{{ route('inventory-logs.destroy', $log->id) }}';
                                        selectedLog = {
                                            product_id: '{{ $log->product_id }}',
                                            product_name: '{{ $log->product->product_name ?? 'Select Product' }}',
                                            type: '{{ $log->type }}',
                                            type_name: '{{ $log->type === 'in' ? 'IN (Stok In)' : 'OUT (Stok Out)' }}',
                                            quantity: '{{ $log->quantity }}',
                                            supplier_id: '{{ $log->supplier_id }}',
                                            supplier_name: '{{ $log->supplier->supplier_name ?? 'Choose Supplier' }}',
                                            notes: '{{ addslashes($log->notes) }}'
                                        };
                                        editOpen = true;
                                    "
                                    class="inline-flex items-center justify-center p-1 rounded-lg transition-all cursor-pointer"
                                    title="Log Options">
                                    <img src="{{ asset('icons/3_dots_icon.png') }}" alt="Options" class="w-4 h-4 object-contain">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">No inventory logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>Showing {{ $logs->firstItem() }}-{{ $logs->lastItem() }} out of {{ $logs->total() }} Logs</div>
                <div>{{ $logs->links('components.pagination') }}</div>
            </div>
        @endif
    </div>


    <!-- ================= MODAL ADD INVENTORY LOG ================= -->
    <template x-teleport="body">
        <div x-show="createOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="createOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Add Inventory Log</h3>
                </div>

                <form action="{{ route('inventory-logs.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Product Selection Custom Dropdown -->
                        <div x-data="{ productOpen: false, productValue: '', productName: 'Select Product' }" class="relative md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product</label>
                            <input type="hidden" name="product_id" x-model="productValue" required>
                            
                            <div class="relative" @click.away="productOpen = false">
                                <button type="button" 
                                    @click="productOpen = !productOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span :class="productValue ? 'text-slate-700' : 'text-slate-400'" x-text="productName"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="productOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="productOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700 max-h-60 overflow-y-auto">
                                    <div @click="productOpen = !productOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span :class="productValue ? 'text-slate-700' : 'text-slate-400'" x-text="productName"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="productOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        @foreach($products as $product)
                                            <div @click="productValue = '{{ $product->id }}'; productName = '{{ $product->product_name }}'; productOpen = false;" 
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="productValue == '{{ $product->id }}' ? 'font-semibold' : null">
                                                {{ $product->product_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Movement Type Custom Dropdown (Fixed Box + Animasi Dua Arah) -->
                        <div x-data="{ typeOpen: false, typeValue: '', typeName: 'Select movement type' }" class="relative">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Movement Type</label>
                            <input type="hidden" name="type" x-model="typeValue" required>
                            
                            <div class="relative" @click.away="typeOpen = false">
                                <button type="button" 
                                    @click="typeOpen = !typeOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span :class="typeValue ? 'text-slate-700' : 'text-slate-400'" x-text="typeName"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="typeOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="typeOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="typeOpen = !typeOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span :class="typeValue ? 'text-slate-700' : 'text-slate-400'" x-text="typeName"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="typeOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        <div @click="typeValue = 'in'; typeName = 'IN (Stok In)'; typeOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="typeValue == 'in' ? 'font-semibold' : null">IN (Stok In)</div>
                                        <div @click="typeValue = 'out'; typeName = 'OUT (Stok Out)'; typeOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="typeValue == 'out' ? 'font-semibold' : null">OUT (Stok Out)</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Quantity</label>
                            <input type="number" name="quantity" min="1" required placeholder="Enter quantity"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Supplier Custom Dropdown (Optional / For IN) -->
                        <div x-data="{ supplierOpen: false, supplierValue: '', supplierName: 'Choose Supplier' }" class="relative md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Supplier</label>
                            <input type="hidden" name="supplier_id" x-model="supplierValue">
                            
                            <div class="relative" @click.away="supplierOpen = false">
                                <button type="button" 
                                    @click="supplierOpen = !supplierOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span :class="supplierValue ? 'text-slate-700' : 'text-slate-400'" x-text="supplierName"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="supplierOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="supplierOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700 max-h-60 overflow-y-auto">
                                    <div @click="supplierOpen = !supplierOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span :class="supplierValue ? 'text-slate-700' : 'text-slate-400'" x-text="supplierName"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="supplierOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        @foreach($suppliers as $supplier)
                                            <div @click="supplierValue = '{{ $supplier->id }}'; supplierName = '{{ $supplier->supplier_name }}'; supplierOpen = false;" 
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="supplierValue == '{{ $supplier->id }}' ? 'font-semibold' : null">
                                                {{ $supplier->supplier_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Notes</label>
                            <textarea name="notes" rows="2" placeholder="Enter any notes or remarks"
                                class="w-full border border-slate-200 rounded-lg p-3 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300"></textarea>
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


    <!-- ================= MODAL EDIT INVENTORY LOG ================= -->
    <template x-teleport="body">
        <div x-show="editOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="editOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Edit Inventory Log</h3>
                </div>

                <form :action="editUrl" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <!-- Product Selection Custom Dropdown (Edit) -->
                        <div x-data="{ editProductOpen: false }" class="relative md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product</label>
                            <input type="hidden" name="product_id" x-model="selectedLog.product_id" required>
                            
                            <div class="relative" @click.away="editProductOpen = false">
                                <button type="button" 
                                    @click="editProductOpen = !editProductOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span class="text-slate-700" x-text="selectedLog.product_name || 'Select Product'"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editProductOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="editProductOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700 max-h-60 overflow-y-auto">
                                    <div @click="editProductOpen = !editProductOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="selectedLog.product_name || 'Select Product'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editProductOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        @foreach($products as $product)
                                            <div @click="selectedLog.product_id = '{{ $product->id }}'; selectedLog.product_name = '{{ $product->product_name }}'; editProductOpen = false;" 
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedLog.product_id == '{{ $product->id }}' ? 'font-semibold' : null">
                                                {{ $product->product_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Movement Type Custom Dropdown (Edit) -->
                        <div x-data="{ editTypeOpen: false }" class="relative">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Movement Type</label>
                            <input type="hidden" name="type" x-model="selectedLog.type" required>
                            
                            <div class="relative" @click.away="editTypeOpen = false">
                                <button type="button" 
                                    @click="editTypeOpen = !editTypeOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span class="text-slate-700" x-text="selectedLog.type_name || 'Select movement type'"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editTypeOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="editTypeOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="editTypeOpen = !editTypeOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="selectedLog.type_name || 'Select movement type'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editTypeOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        <div @click="selectedLog.type = 'in'; selectedLog.type_name = 'IN (Stok In)'; editTypeOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedLog.type == 'in' ? 'font-semibold' : null">IN (Stok In)</div>
                                        <div @click="selectedLog.type = 'out'; selectedLog.type_name = 'OUT (Stok Out)'; editTypeOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedLog.type == 'out' ? 'font-semibold' : null">OUT (Stok Out)</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity (Edit) -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Quantity</label>
                            <input type="number" name="quantity" min="1" x-model="selectedLog.quantity" required placeholder="Enter quantity"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Supplier Custom Dropdown (Edit) -->
                        <div x-data="{ editSupplierOpen: false }" class="relative md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Supplier</label>
                            <input type="hidden" name="supplier_id" x-model="selectedLog.supplier_id">
                            
                            <div class="relative" @click.away="editSupplierOpen = false">
                                <button type="button" 
                                    @click="editSupplierOpen = !editSupplierOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span class="text-slate-700" x-text="selectedLog.supplier_name || 'Choose Supplier'"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editSupplierOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="editSupplierOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700 max-h-60 overflow-y-auto">
                                    <div @click="editSupplierOpen = !editSupplierOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="selectedLog.supplier_name || 'Choose Supplier'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editSupplierOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        @foreach($suppliers as $supplier)
                                            <div @click="selectedLog.supplier_id = '{{ $supplier->id }}'; selectedLog.supplier_name = '{{ $supplier->supplier_name }}'; editSupplierOpen = false;" 
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedLog.supplier_id == '{{ $supplier->id }}' ? 'font-semibold' : null">
                                                {{ $supplier->supplier_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes (Edit) -->
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Notes</label>
                            <textarea name="notes" rows="2" x-model="selectedLog.notes" placeholder="Enter any notes or remarks"
                                class="w-full border border-slate-200 rounded-lg p-3 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300"></textarea>
                        </div>

                    </div>

                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="editOpen = false" class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">Cancel</button>
                        <button type="button" @click="
                            if(confirm('Are you sure you want to delete this log?')) {
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