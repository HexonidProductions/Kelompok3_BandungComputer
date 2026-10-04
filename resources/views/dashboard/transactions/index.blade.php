@extends('layouts.app')

@section('content')
<div x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '',
    selectedTx: {}
}" class="space-y-6">

    <!-- Header & Action Bar -->
    <div class="space-y-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-medium text-slate-900">Transactions</h1>

        <!-- Search Bar, Filter Status & Add Transaction Button -->
        <div class="flex flex-wrap justify-between items-center gap-4">
            <!-- Bungkus Search & Filter dalam satu container agar rapi di sebelah kiri -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search Form -->
                <form action="{{ route('transactions.index') }}" method="GET" class="relative w-72">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{ asset('icons/ci_search-magnifying-glass.png') }}" alt="Search" class="w-4 h-4">
                    </div>
                    <input type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search Invoice code, admin, or customer" 
                        class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-600 focus:outline-none focus:ring-0 focus:border-slate-300">
                </form>

                <!-- Payment Status Custom Dropdown with Rotating Arrow Icon -->
                <div x-data="{ open: false }" class="relative inline-block text-left" @click.away="open = false">
                    <button type="button" 
                        @click="open = !open" 
                        class="inline-flex items-center justify-between gap-3 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white px-3 py-2 focus:outline-none focus:border-slate-300 shadow-sm cursor-pointer min-w-[160px]">
                        <span>
                            @if(request('status') == 'paid')
                                Payment Status: Paid
                            @elseif(request('status') == 'not paid')
                                Payment Status: Not Paid
                            @else
                                Payment Status: All
                            @endif
                        </span>
                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                            alt="Arrow" 
                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                            :class="open ? 'rotate-180' : 'rotate-0'">
                    </button>

                    <div x-show="open" 
                        x-cloak
                        class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1 text-xs text-slate-700">
                        <a href="{{ request()->fullUrlWithQuery(['status' => '']) }}" 
                            class="block px-3 py-2 hover:bg-slate-50 transition-colors {{ request('status') == '' ? 'font-semibold text-blue-600' : '' }}">
                            Payment Status: All
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'paid']) }}" 
                            class="block px-3 py-2 hover:bg-slate-50 transition-colors {{ request('status') == 'paid' ? 'font-semibold text-blue-600' : '' }}">
                            Payment Status: Paid
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'not paid']) }}" 
                            class="block px-3 py-2 hover:bg-slate-50 transition-colors {{ request('status') == 'not paid' ? 'font-semibold text-blue-600' : '' }}">
                            Payment Status: Not Paid
                        </a>
                    </div>
                </div>
            </div> <!-- <-- Penutup container kiri (Search & Filter) sudah benar di sini -->

            <!-- Add Transaction Button (Berdiri sendiri di sebelah kanan berkat justify-between) -->
            <button type="button" 
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add Transaction" class="w-4 h-4" object-contain> Add Transaction
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <!-- Table Title -->
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Transaction List</h3>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-3 rounded-l-lg">Receipt Number</th>
                        <th class="py-3 px-3">Sale Type</th>
                        <th class="py-3 px-3">Cashier</th>
                        <th class="py-3 px-3">Customer</th>
                        <th class="py-3 px-3 max-w-xs">Shipping Address</th>
                        <th class="py-3 px-3">Date</th>
                        <th class="py-3 px-3">Total Amount</th>
                        <th class="py-3 px-3">Payment Method</th>
                        <th class="py-3 px-3">Shipping Fee</th>
                        <th class="py-3 px-3 text-center">Payment Status</th>
                        <th class="py-3 px-3 rounded-r-lg text-center w-16">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($transactions as $tx)
                        <tr>
                            <td class="py-3.5 px-3 font-bold text-slate-900 whitespace-nowrap">
                                {{ $tx->receipt_number }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">{{ $tx->sale_type }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap">{{ $tx->admin->name ?? '-' }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap font-medium text-slate-900">{{ $tx->customer->name ?? '-' }}</td>
                            <td class="py-3.5 px-3 text-slate-700 max-w-[200px] truncate leading-relaxed text-[11px]" title="{{ $tx->shipping_address }}">
                                {{ $tx->shipping_address ?? '-' }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-700">{{ $tx->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="py-3.5 px-3 font-semibold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($tx->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">{{ $tx->payment_method }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-500">
                                Rp {{ number_format($tx->shipping_fee ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
                            @if(strtolower($tx->payment_status) === 'paid')
                            <!-- Status Paid (Warna Hijau) -->
                            <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#16A34A] text-[#000000] bg-white">
                            Paid
                            </span>
                            @elseif(strtolower($tx->payment_status) === 'not paid')
                            <!-- Status Not Paid (Warna Merah) -->
                            <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#DC2626] text-[#000000] bg-white">
                            Not Paid
                            </span>
                            @endif
                            </td>
                            <td class="py-3.5 px-3 text-center">
                                <!-- Action Button: Three Dots (...) -->
                                <button type="button" 
                                    @click="
                                        editUrl = '{{ route('transactions.update', $tx->id) }}';
                                        deleteUrl = '{{ route('transactions.destroy', $tx->id) }}';
                                        selectedTx = {{ json_encode($tx) }};
                                        editOpen = true;
                                    "
                                    class="inline-flex items-center justify-center p-1 rounded-lg transition-all"
                                    title="Transaction Options">
                                    <img src="{{ asset('icons/3_dots_icon.png') }}" alt="Options" class="w-4 h-4 object-contain">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="py-8 text-center text-slate-400">
                                No transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer & Pagination -->
        @if($transactions->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>
                    Showing {{ $transactions->firstItem() }}-{{ $transactions->lastItem() }} out of {{ $transactions->total() }} Transactions
                </div>
                <div>
                    {{ $transactions->links('components.pagination') }}
                </div>
            </div>
        @endif
    </div>

    <!-- Hidden Form Global Delete -->
    <form x-ref="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <!-- Modal Teleport ke Body -->
    <template x-teleport="body">
        <div x-show="createOpen || editOpen" x-cloak>
            
            <!-- Modal Edit Transaction Details -->
            <div x-show="editOpen" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
                @keydown.escape.window="editOpen = false">

                <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="editOpen = false">
                    <h3 class="text-base font-bold text-slate-900 mb-5">Edit Transaction Details</h3>

                    <form :action="editUrl" method="POST"
                        x-data="{
                            items: [],
                            itemModalOpen: false,
                            editingIndex: null,
                            productId: '',
                            productName: '',
                            itemQty: 1,
                            itemPrice: 0,
                            selectedStock: 0,
                            
                            init() {
                                $watch('selectedTx', value => {
                                    if (value && (value.items || value.sale_items)) {
                                        let rawItems = value.items || value.sale_items;
                                        
                                        if (typeof rawItems === 'string') {
                                            try {
                                                rawItems = JSON.parse(rawItems);
                                            } catch(e) {
                                                rawItems = [];
                                            }
                                        }

                                        this.items = rawItems.map(item => {
                                            let resolvedName = item.product?.product_name || item.product_name || item.name || ('Product ' + (item.product_id || ''));
                                            return {
                                                id: item.id || null,
                                                product_id: item.product_id || null,
                                                name: resolvedName,
                                                product_name: resolvedName,
                                                quantity: Number(item.quantity) || 1,
                                                price: Number(item.unit_price || item.price) || 0
                                            };
                                        });
                                    } else {
                                        this.items = [];
                                    }
                                });
                            },

                            openAddItem() {
                                this.productId = '';
                                this.productName = '';
                                this.itemQty = 1;
                                this.itemPrice = 0;
                                this.selectedStock = 0;
                                this.editingIndex = null;
                                this.itemModalOpen = true;
                            },
                            
                            openEditItem(index) {
                                this.editingIndex = index;
                                this.productId = this.items[index].product_id || '';
                                this.productName = this.items[index].name || this.items[index].product_name || '';
                                this.itemQty = this.items[index].quantity || 1;
                                this.itemPrice = this.items[index].price || 0;
                                this.selectedStock = 999;
                                this.itemModalOpen = true;
                            },

                            saveItem() {
                                if (!this.productName.trim()) {
                                    alert('Please select a product first!');
                                    return;
                                }

                                if (this.editingIndex === null) {
                                    if (this.selectedStock <= 0) {
                                        alert('Produk ini out of stock dan tidak dapat ditambahkan!');
                                        return;
                                    }
                                    if (this.itemQty > this.selectedStock) {
                                        alert('Jumlah pesanan (' + this.itemQty + ') melebihi stok yang tersedia (' + this.selectedStock + ')!');
                                        return;
                                    }
                                }
                                
                                const payload = {
                                    product_id: this.productId,
                                    name: this.productName,
                                    product_name: this.productName,
                                    quantity: Number(this.itemQty) || 1,
                                    price: Number(this.itemPrice) || 0
                                };

                                if (this.editingIndex !== null) {
                                    this.items[this.editingIndex] = payload;
                                } else {
                                    this.items.push(payload);
                                }
                                
                                this.itemModalOpen = false;
                            },

                            removeItem(index) {
                                if (confirm('Are you sure you want to delete this product from the transaction list?')) {
                                    this.items.splice(index, 1);
                                }
                            }
                        }">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="items" :value="JSON.stringify(items)">

                        <div class="grid grid-cols-2 gap-4 mb-4 text-xs">
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Receipt Number</label>
                                <input type="text" x-model="selectedTx.receipt_number" readonly class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-500 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px]" placeholder="Receipt Number">
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Type</label>
                                <input type="hidden" name="sale_type" x-model="selectedTx.sale_type">
                                <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                    <button type="button" 
                                        @click="open = !open" 
                                        class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                                        <span x-text="selectedTx.sale_type || 'Select Type'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                            :class="open ? 'rotate-180' : 'rotate-0'">
                                    </button>

                                    <div x-show="open" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1">
                                        <div @click="selectedTx.sale_type = 'Offline'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Offline</div>
                                        <div @click="selectedTx.sale_type = 'Online'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Online</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Cashier</label>
                                <input type="text" readonly :value="selectedTx.admin?.name || '-'" class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-500 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px]" placeholder="Cashier Name">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Customer</label>
                                <input type="text" readonly :value="selectedTx.customer?.name || '-'" class="w-full border border-slate-200 bg-slate-50 rounded-lg px-3 py-2 text-slate-500 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px]" placeholder="Customer Name">
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Payment Method</label>
                                <input type="hidden" name="payment_method" x-model="selectedTx.payment_method">
                                <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                    <button type="button" 
                                        @click="open = !open" 
                                        class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                                        <span x-text="selectedTx.payment_method || 'Select Payment Method'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                            :class="open ? 'rotate-180' : 'rotate-0'">
                                    </button>

                                    <div x-show="open" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1">
                                        <div @click="selectedTx.payment_method = 'Bank Transfer'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Bank Transfer</div>
                                        <div @click="selectedTx.payment_method = 'Cash'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Cash</div>
                                        <div @click="selectedTx.payment_method = 'QRIS'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">QRIS</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Payment Status</label>
                                <input type="hidden" name="payment_status" x-model="selectedTx.payment_status">
                                <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                    <button type="button" 
                                        @click="open = !open" 
                                        class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                                        <span x-text="selectedTx.payment_status === 'not paid' ? 'not paid' : (selectedTx.payment_status || 'Select Payment Status')"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                            :class="open ? 'rotate-180' : 'rotate-0'">
                                    </button>

                                    <div x-show="open" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1">
                                        <div @click="selectedTx.payment_status = 'paid'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">paid</div>
                                        <div @click="selectedTx.payment_status = 'not paid'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">not paid</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Shipping Fee</label>
                                <input type="number" name="shipping_fee" x-model="selectedTx.shipping_fee" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px] [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Total Amount</label>
                                <input type="number" name="total_amount" x-model="selectedTx.total_amount" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px] [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                            </div>
                        </div>

                        <div class="mb-5 text-xs">
                            <label class="block font-semibold text-slate-700 mb-1">Shipping Address</label>
                            <textarea name="shipping_address" x-model="selectedTx.shipping_address" rows="2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px]" placeholder="Enter shipping address"></textarea>
                        </div>

                        <!-- Items Section (Edit) -->
                        <div class="mb-5 pt-4 border-slate-100 text-xs">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-bold text-slate-800 text-sm">Items</span>
                                <button type="button" @click="openAddItem()" class="inline-flex items-center gap-1 h-[22px] border-[1.5px] border-[#000000] rounded-[5px] px-3 py-1.5 font-semibold text-slate-900 hover:bg-slate-50 transition-colors shadow-sm">
                                    <img src="{{ asset('icons/plus_icon_(2).png') }}" alt="Plus Icon" class="w-3 h-3 object-contain"> Add Item
                                </button>
                            </div>

                            <template x-if="items.length === 0">
                                <div class="text-slate-400 py-3 text-center">
                                    No items added yet.
                                </div>
                            </template>

                            <div class="space-y-2">
                                <template x-for="(item, index) in items" :key="index">
                                    <div class="flex items-center justify-between py-2 text-xs">
                                        <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                            <span x-text="(item.quantity || 1) + 'x'" class="text-slate-600 font-semibold"></span>
                                            <span x-text="item.name || item.product_name"></span>
                                        </div>
                                        
                                        <div class="flex items-center gap-4">
                                            <span class="font-semibold text-slate-800" x-text="'Rp ' + Number((item.quantity || 1) * (item.price || 0)).toLocaleString('id-ID')"></span>
                                            
                                            <div class="flex items-center gap-2">
                                                <button type="button" @click="openEditItem(index)" class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                                   <img src="{{ asset('icons/pencil.png') }}" alt="Edit Icon" class="w-4 h-4 object-contain">
                                                </button>
                                                <button type="button" @click="removeItem(index)" class="p-1 text-rose-400 hover:text-rose-600 transition-colors">
                                                    <img src="{{ asset('icons/trash.png') }}" alt="Trash Icon" class="w-4 h-4 object-contain">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Sub Modal Add/Edit Item (Edit Modal) - Custom Dropdown with Arrow Animation -->
                        <div x-show="itemModalOpen" x-cloak 
                            class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
                            @keydown.escape.window="itemModalOpen = false">
                            
                            <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-5 relative" @click.away="itemModalOpen = false">
                                <h4 class="text-sm font-bold text-slate-900 mb-4" x-text="editingIndex !== null ? 'Edit Item' : 'Add New Item'"></h4>
                                
                                <div class="space-y-3 text-xs mb-4">
                                    <div>
                                        <label class="block font-semibold text-slate-700 mb-1">Product</label>
                                        
                                        <!-- Custom Dropdown Product -->
                                        <div x-data="{ productOpen: false }" class="relative" @click.away="productOpen = false">
                                            <button type="button" 
                                                @click="productOpen = !productOpen" 
                                                class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300 text-xs">
                                                <span x-text="productName || 'Select Product'"></span>
                                                <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                                    alt="Arrow" 
                                                    class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                                    :class="productOpen ? 'rotate-180' : 'rotate-0'">
                                            </button>

                                            <div x-show="productOpen" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1 max-h-48 overflow-y-auto">
                                                @foreach($products ?? [] as $prod)
                                                    @php
                                                        $isOut = $prod->stock <= 0 || $prod->status === 'Out of stock';
                                                    @endphp
                                                    @if(!$isOut)
                                                        <div @click="
                                                            productId = '{{ $prod->id }}';
                                                            productName = '{{ $prod->product_name }}';
                                                            itemPrice = Number('{{ $prod->price }}');
                                                            selectedStock = Number('{{ $prod->stock }}');
                                                            productOpen = false;
                                                        " class="px-3 py-2 hover:bg-slate-50 cursor-pointer text-xs">
                                                            {{ $prod->product_name }} (Stock: {{ $prod->stock }})
                                                        </div>
                                                    @else
                                                        <div class="px-3 py-2 text-slate-300 cursor-not-allowed text-xs">
                                                            {{ $prod->product_name }} (Out of Stock)
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block font-semibold text-slate-700 mb-1">Quantity</label>
                                            <input type="number" min="1" x-model.number="itemQty" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-slate-300 focus:ring-0 [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="1">
                                        </div>
                                        <div>
                                            <label class="block font-semibold text-slate-700 mb-1">Unit Price</label>
                                            <input type="number" min="0" x-model.number="itemPrice" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-slate-300 focus:ring-0 [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-2.5">
                                    <button type="button" @click="itemModalOpen = false" class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="button" @click="saveItem()" class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                                        Save Item
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-2.5">
                            <button type="button" 
                                @click="editOpen = false" 
                                class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                                Cancel
                            </button>

                            <button type="button" 
                                @click="if (confirm('Are you sure you want to delete this transaction?')) { $refs.globalDeleteForm.action = deleteUrl; $refs.globalDeleteForm.submit(); }" 
                                class="w-20 h-8 flex items-center justify-center border border-[#DC2626] text-[#DC2626] hover:bg-[#DC2626]/5 rounded-[5px] text-xs font-medium transition-colors">
                                Delete
                            </button>

                            <button type="submit" 
                                @click="if (!confirm('Are you sure you want to save these changes?')) $event.preventDefault()" 
                                class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Add Transaction -->
            <div x-show="createOpen" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
                @keydown.escape.window="createOpen = false">

                <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="createOpen = false">
                    <h3 class="text-base font-bold text-slate-900 mb-5">Add New Transaction</h3>

                    <form action="{{ route('transactions.store') }}" method="POST"
                        x-data="{ 
                            saleType: 'Offline', 
                            paymentMethod: '', 
                            paymentStatus: '',
                            items: [],
                            itemModalOpen: false,
                            editingIndex: null,
                            productId: '',
                            productName: '',
                            itemQty: 1,
                            itemPrice: 0,
                            selectedStock: 0,
                            
                            openAddItem() {
                                this.productId = '';
                                this.productName = '';
                                this.itemQty = 1;
                                this.itemPrice = 0;
                                this.selectedStock = 0;
                                this.editingIndex = null;
                                this.itemModalOpen = true;
                            },
                            
                            openEditItem(index) {
                                this.editingIndex = index;
                                this.productId = this.items[index].product_id || '';
                                this.productName = this.items[index].name || this.items[index].product_name || '';
                                this.itemQty = this.items[index].quantity || 1;
                                this.itemPrice = this.items[index].price || 0;
                                this.selectedStock = 999;
                                this.itemModalOpen = true;
                            },

                            saveItem() {
                                if (!this.productName.trim()) {
                                    alert('Please select a product first!');
                                    return;
                                }

                                if (this.editingIndex === null) {
                                    if (this.selectedStock <= 0) {
                                        alert('Produk ini out of stock dan tidak dapat ditambahkan!');
                                        return;
                                    }
                                    if (this.itemQty > this.selectedStock) {
                                        alert('Jumlah pesanan (' + this.itemQty + ') melebihi stok yang tersedia (' + this.selectedStock + ')!');
                                        return;
                                    }
                                }
                                
                                const payload = {
                                    product_id: this.productId,
                                    name: this.productName,
                                    product_name: this.productName,
                                    quantity: Number(this.itemQty) || 1,
                                    price: Number(this.itemPrice) || 0
                                };

                                if (this.editingIndex !== null) {
                                    this.items[this.editingIndex] = payload;
                                } else {
                                    this.items.push(payload);
                                }
                                
                                this.itemModalOpen = false;
                            },

                            removeItem(index) {
                                if (confirm('Apakah Anda yakin ingin menghapus produk ini dari daftar transaksi?')) {
                                    this.items.splice(index, 1);
                                }
                            }
                        }">
                        @csrf

                        <input type="hidden" name="sale_type" :value="saleType">
                        <input type="hidden" name="payment_method" :value="paymentMethod">
                        <input type="hidden" name="payment_status" :value="paymentStatus">
                        <input type="hidden" name="items" :value="JSON.stringify(items)">

                        <div class="grid grid-cols-2 gap-4 mb-4 text-xs">
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Receipt Number</label>
                                <input type="text" name="receipt_number" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px]" placeholder="Receipt Number">
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Type</label>
                                <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                    <button type="button" 
                                        @click="open = !open" 
                                        class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                                        <span x-text="saleType || 'Select Type'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                            :class="open ? 'rotate-180' : 'rotate-0'">
                                    </button>

                                    <div x-show="open" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1">
                                        <div @click="saleType = 'Offline'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Offline</div>
                                        <div @click="saleType = 'Online'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Online</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Cashier</label>
                                <select name="admin_id" required class="w-full h-[40px] border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300 text-xs">
                                    <option value="">Select Cashier</option>
                                    @foreach($admins ?? [] as $admin)
                                        <option value="{{ $admin->id }}" {{ auth()->id() == $admin->id ? 'selected' : '' }}>
                                            {{ $admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Customer</label>
                                <select name="customer_id" class="w-full h-[40px] border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300 text-xs">
                                    <option value="">Select Customer</option>
                                    @foreach($customers ?? [] as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Payment Method</label>
                                <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                    <button type="button" 
                                        @click="open = !open" 
                                        class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                                        <span x-text="paymentMethod || 'Select Payment Method'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                            :class="open ? 'rotate-180' : 'rotate-0'">
                                    </button>

                                    <div x-show="open" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1">
                                        <div @click="paymentMethod = 'Bank Transfer'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Bank Transfer</div>
                                        <div @click="paymentMethod = 'Cash'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">Cash</div>
                                        <div @click="paymentMethod = 'QRIS'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">QRIS</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Payment Status</label>
                                <div x-data="{ open: false }" class="relative" @click.away="open = false">
                                    <button type="button" 
                                        @click="open = !open" 
                                        class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                                        <span x-text="paymentStatus === 'not paid' ? 'not paid' : (paymentStatus || 'Select Payment Status')"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                            :class="open ? 'rotate-180' : 'rotate-0'">
                                    </button>

                                    <div x-show="open" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1">
                                        <div @click="paymentStatus = 'paid'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">paid</div>
                                        <div @click="paymentStatus = 'not paid'; open = false" class="px-3 py-2 hover:bg-slate-50 cursor-pointer">not paid</div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Shipping Fee</label>
                                <input type="number" name="shipping_fee" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px] [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Total Amount</label>
                                <input type="number" name="total_amount" required class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px] [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                            </div>
                        </div>

                        <div class="mb-5 text-xs">
                            <label class="block font-semibold text-slate-700 mb-1">Shipping Address</label>
                            <textarea name="shipping_address" rows="2" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 placeholder:text-[13px]" placeholder="Enter shipping address"></textarea>
                        </div>

                        <!-- Items Section (Add) -->
                        <div class="mb-5 pt-4 border-slate-100 text-xs">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-bold text-slate-800 text-sm">Items</span>
                                <button type="button" @click="openAddItem()" class="inline-flex items-center gap-1 h-[22px] border-[1.5px] border-[#000000] rounded-[5px] px-3 py-1.5 font-semibold text-slate-900 hover:bg-slate-50 transition-colors shadow-sm">
                                    <img src="{{ asset('icons/plus_icon_(2).png') }}" alt="Plus Icon" class="w-3 h-3 object-contain"> Add Item
                                </button>
                            </div>

                            <template x-if="items.length === 0">
                                <div class="text-slate-400 py-3 text-center">
                                    No items added yet.
                                </div>
                            </template>

                            <div class="space-y-2">
                                <template x-for="(item, index) in items" :key="index">
                                    <div class="flex items-center justify-between py-2 text-xs">
                                        <div class="flex items-center gap-1.5 font-medium text-slate-800">
                                            <span x-text="(item.quantity || 1) + 'x'" class="text-slate-600 font-semibold"></span>
                                            <span x-text="item.name || item.product_name"></span>
                                        </div>
                                        
                                        <div class="flex items-center gap-4">
                                            <span class="font-semibold text-slate-800" x-text="'Rp ' + Number((item.quantity || 1) * (item.price || 0)).toLocaleString('id-ID')"></span>
                                            
                                            <div class="flex items-center gap-2">
                                                <button type="button" @click="openEditItem(index)" class="p-1 text-slate-400 hover:text-slate-600 transition-colors">
                                                     <img src="{{ asset('icons/pencil.png') }}" alt="Edit Icon" class="w-4 h-4 object-contain">
                                                </button>
                                                <button type="button" @click="removeItem(index)" class="p-1 text-rose-400 hover:text-rose-600 transition-colors">
                                                     <img src="{{ asset('icons/trash.png') }}" alt="Trash Icon" class="w-4 h-4 object-contain">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Sub Modal Add/Edit Item (Add Modal) - Custom Dropdown with Arrow Animation -->
                        <div x-show="itemModalOpen" x-cloak 
                            class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
                            @keydown.escape.window="itemModalOpen = false">
                            
                            <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-5 relative" @click.away="itemModalOpen = false">
                                <h4 class="text-sm font-bold text-slate-900 mb-4" x-text="editingIndex !== null ? 'Edit Item' : 'Add New Item'"></h4>
                                
                                <div class="space-y-3 text-xs mb-4">
                                    <div>
                                        <label class="block font-semibold text-slate-700 mb-1">Product</label>
                                        
                                        <!-- Custom Dropdown Product -->
                                        <div x-data="{ productOpen: false }" class="relative" @click.away="productOpen = false">
                                            <button type="button" 
                                                @click="productOpen = !productOpen" 
                                                class="w-full h-[40px] flex items-center justify-between border border-slate-200 rounded-lg px-3 py-2 text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300 text-xs">
                                                <span x-text="productName || 'Select Product'"></span>
                                                <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                                    alt="Arrow" 
                                                    class="w-2.5 h-2.5 object-contain transition-transform duration-200"
                                                    :class="productOpen ? 'rotate-180' : 'rotate-0'">
                                            </button>

                                            <div x-show="productOpen" x-cloak class="absolute left-0 mt-1 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 py-1 max-h-48 overflow-y-auto">
                                                @foreach($products ?? [] as $prod)
                                                    @php
                                                        $isOut = $prod->stock <= 0 || $prod->status === 'Out of stock';
                                                    @endphp
                                                    @if(!$isOut)
                                                        <div @click="
                                                            productId = '{{ $prod->id }}';
                                                            productName = '{{ $prod->product_name }}';
                                                            itemPrice = Number('{{ $prod->price }}');
                                                            selectedStock = Number('{{ $prod->stock }}');
                                                            productOpen = false;
                                                        " class="px-3 py-2 hover:bg-slate-50 cursor-pointer text-xs">
                                                            {{ $prod->product_name }} (Stock: {{ $prod->stock }})
                                                        </div>
                                                    @else
                                                        <div class="px-3 py-2 text-slate-300 cursor-not-allowed text-xs">
                                                            {{ $prod->product_name }} (Out of Stock)
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label class="block font-semibold text-slate-700 mb-1">Quantity</label>
                                            <input type="number" min="1" x-model.number="itemQty" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-slate-300 focus:ring-0 [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="1">
                                        </div>
                                        <div>
                                            <label class="block font-semibold text-slate-700 mb-1">Unit Price</label>
                                            <input type="number" min="0" x-model.number="itemPrice" class="w-full border border-slate-200 rounded-lg px-3 py-2 text-slate-700 focus:outline-none focus:border-slate-300 focus:ring-0 [appearance: textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Rp 0">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end gap-2.5">
                                    <button type="button" @click="itemModalOpen = false" class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                                        Cancel
                                    </button>
                                    <button type="button" @click="saveItem()" class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                                        Save Item
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-2.5">
                            <button type="button" 
                                @click="createOpen = false" 
                                class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                                Cancel
                            </button>

                            <button type="submit" 
                                @click="if (!confirm('Are you sure you want to add this transaction?')) $event.preventDefault()" 
                                class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </template>
</div>
@endsection