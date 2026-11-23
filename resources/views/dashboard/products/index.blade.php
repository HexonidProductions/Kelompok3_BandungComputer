@extends('layouts.app')

@section('content')
<div class="space-y-6" x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '',
    selectedProduct: {},
    addPreviewUrl: null,
    editPreviewUrl: null
}">

    <!-- Header & Action Bar -->
    <div class="space-y-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-medium text-slate-900">Products</h1>

        <!-- Search Bar, Status Filter & Add Product Button -->
        <div class="flex flex-wrap justify-between items-center gap-4">
            <!-- Container Kiri: Search & Status Filter -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="GET" class="relative w-72">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{ asset('icons/ci_search-magnifying-glass.png') }}" alt="Search" class="w-4 h-4">
                    </div>
                    <input type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search product name or code" 
                        class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-600 focus:outline-none focus:ring-0 focus:border-slate-300">
                </form>

                <!-- Product Status Custom Dropdown (Fixed Box + Animasi Dua Arah) -->
                <div x-data="{ open: false }" class="relative inline-block text-left min-w-[160px]" @click.away="open = false">
                    <!-- Tombol Utama (Ukuran Fix) -->
                    <button type="button" 
                        @click="open = !open" 
                        class="inline-flex items-center justify-between gap-3 w-full px-3 py-2 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300 cursor-pointer shadow-sm">
                        <span>
                            @if(request('status') == 'Available')
                                Status: Available
                            @elseif(request('status') == 'Low stock')
                                Status: Low stock
                            @elseif(request('status') == 'Inden')
                                Status: Inden
                            @elseif(request('status') == 'Out of stock')
                                Status: Out of stock
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
                        <div @click="open = !open" class="h-9 flex items-center justify-between px-3 cursor-pointer">
                            <span>
                                @if(request('status') == 'Available')
                                    Status: Available
                                @elseif(request('status') == 'Low stock')
                                    Status: Low stock
                                @elseif(request('status') == 'Inden')
                                    Status: Inden
                                @elseif(request('status') == 'Out of stock')
                                    Status: Out of stock
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
                                class="block px-3 py-2.5 transition-colors {{ request('status') == '' ? 'font-semibold' : null }}">
                                Status: All
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'Available']) }}" 
                                class="block px-3 py-2.5 transition-colors {{ request('status') == 'Available' ? 'font-semibold' : null }}">
                                Status: Available
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'Low stock']) }}" 
                                class="block px-3 py-2.5 transition-colors {{ request('status') == 'Low stock' ? 'font-semibold' : null }}">
                                Status: Low stock
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'Inden']) }}" 
                                class="block px-3 py-2.5 transition-colors {{ request('status') == 'Inden' ? 'font-semibold' : null }}">
                                Status: Inden
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'Out of stock']) }}" 
                                class="block px-3 py-2.5 transition-colors {{ request('status') == 'Out of stock' ? 'font-semibold' : null }}">
                                Status: Out of stock
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Product Button -->
            <button type="button" 
                @click="createOpen = true; addPreviewUrl = null;" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all cursor-pointer">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add Product" class="w-4 h-4 object-contain"> Add Product
            </button>   
        </div>
    </div>

    <!-- 3 Statistic Cards (Dipaksa berjajar ke samping menggunakan inline flex/grid style) -->
    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 1rem;">
        
        <!-- Card 1: Total Registered Products -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Total Registered Products</p>
                <h3 class="text-xl font-bold text-slate-900">{{ $totalProducts ?? 0 }} Unit</h3>
            </div>
            <!-- Icon Placeholder -->
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/fa7-solid_exchange-alt.png') }}" alt="Total Products Icon" class="w-6 h-6 object-contain">
            </div>
        </div>

        <!-- Card 2: Products Low On Stock -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Products Low On Stock</p>
                <h3 class="text-xl font-bold text-slate-900">{{ $productsLowStock ?? 0 }} Item</h3>
            </div>
            <!-- Icon Placeholder -->
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/fa7-solid_exchange-alt (1).png') }}" alt="Low Stock Icon" class="w-6 h-6 object-contain">
            </div>
        </div>

        <!-- Card 3: Active Category -->
        <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200/80 flex justify-between items-start">
            <div>
                <p class="text-xs text-slate-500 font-medium mb-1">Active Category</p>
                <h3 class="text-xl font-bold text-slate-900">{{ $activeCategory ?? 0 }} Category</h3>
            </div>
            <!-- Icon Placeholder -->
            <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 shrink-0">
                <img src="{{ asset('icons/fa7-solid_exchange-alt (2).png') }}" alt="Active Category Icon" class="w-6 h-6 object-contain">
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <!-- Table Title -->
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Product List</h3>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-3 rounded-l-lg">Product Code</th>
                        <th class="py-3 px-3">Image</th>
                        <th class="py-3 px-3">Product Name</th>
                        <th class="py-3 px-3">Category</th>
                        <th class="py-3 px-3 max-w-xs">Description</th>
                        <th class="py-3 px-3">Buy Price</th>
                        <th class="py-3 px-3">Sell Price</th>
                        <th class="py-3 px-3">Stock</th>
                        <th class="py-3 px-3 text-center">Status</th>
                        <th class="py-3 px-3">Updated at</th>
                        <th class="py-3 px-3 rounded-r-lg text-center w-16">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($products as $product)
                        <tr>
                            <td class="py-3.5 px-3 font-bold text-slate-900 whitespace-nowrap">
                                {{ $product->product_code }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}" class="w-10 h-10 object-cover rounded-md">
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap font-medium text-slate-900">{{ $product->product_name }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap">{{ $product->category->category_name ?? '-' }}</td>
                            <td class="py-3.5 px-3 text-slate-700 max-w-[200px] truncate leading-relaxed text-[11px]" title="{{ $product->description }}">
                                {{ $product->description ?? '-' }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-600">
                                Rp {{ number_format($product->buy_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-3 font-semibold text-slate-900 whitespace-nowrap">
                                Rp {{ number_format($product->sell_price ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap font-semibold">{{ $product->stock }}</td>
                            <td class="py-3.5 px-3 text-center whitespace-nowrap">
    @if($product->status === 'Available')
        <span class="inline-flex items-center justify-center w-24 py-1 rounded-md text-[11px] font-semibold border-2 border-[#16A34A] text-[#000000] bg-white">
            Available
        </span>
    @elseif($product->status === 'Low stock')
        <span class="inline-flex items-center justify-center w-24 py-1 rounded-md text-[11px] font-semibold border-2 border-[#F59E0B] text-[#000000] bg-white">
            Low stock
        </span>
    @elseif($product->status === 'Inden')
        <span class="inline-flex items-center justify-center w-24 py-1 rounded-md text-[11px] font-semibold border-2 border-[#2563EB] text-[#000000] bg-white">
            Inden
        </span>
    @else
        <span class="inline-flex items-center justify-center w-24 py-1 rounded-md text-[11px] font-semibold border-2 border-[#DC2626] text-[#000000] bg-white">
            Out of stock
        </span>
    @endif
</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-500">{{ $product->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td class="py-3.5 px-3 text-center">
                                <!-- Action Button: Options -->
                                <button type="button" 
                                    @click="
                                        editUrl = '{{ route('products.update', $product->id) }}';
                                        deleteUrl = '{{ route('products.destroy', $product->id) }}';
                                        selectedProduct = {{ json_encode($product) }};
                                        editPreviewUrl = null;
                                        editOpen = true;
                                    "
                                    class="inline-flex items-center justify-center p-1 rounded-lg transition-all cursor-pointer"
                                    title="Product Options">
                                    <img src="{{ asset('icons/3_dots_icon.png') }}" alt="Options" class="w-4 h-4 object-contain">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="py-8 text-center text-slate-400">
                                No products found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer & Pagination -->
        @if($products->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>
                    Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} out of {{ $products->total() }} Products
                </div>
                <div>
                    {{ $products->links('components.pagination') }}
                </div>
            </div>
        @endif
    </div>


    <!-- ================= MODAL ADD PRODUCT (Teleport ke Body) ================= -->
    <template x-teleport="body">
        <div x-show="createOpen" 
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
            x-data="{ 
                categoryOpen: false, 
                selectedCategoryName: 'Select Product Category', 
                categoryId: '', 
                statusOpen: false, 
                selectedStatus: 'Available',
                addPreviewUrl: null,
                handleImageChange(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        this.addPreviewUrl = null;
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran foto maksimal adalah 5MB. Silakan pilih foto lain.'
                        });
                        e.target.value = '';
                        this.addPreviewUrl = null;
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        this.addPreviewUrl = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }">
            
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="createOpen = false; addPreviewUrl = null;">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Add New Product</h3>
                </div>

                <!-- Form Add -->
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Name</label>
                            <input type="text" name="product_name" required placeholder="Enter product name" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Product Code -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Code</label>
                            <input type="text" name="product_code" required placeholder="Enter product code" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Category</label>
                            <input type="hidden" name="category_id" x-model="categoryId" required>
                            
                            <div class="relative" @click.away="categoryOpen = false">
                                <button type="button" 
                                    @click="categoryOpen = !categoryOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none cursor-pointer">
                                    <span :class="categoryId ? 'text-slate-700' : 'text-slate-400'" x-text="selectedCategoryName"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                        alt="Arrow" 
                                        class="w-2.5 h-2.5 object-contain"
                                        :class="categoryOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="categoryOpen" 
                                    x-cloak
                                    class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="categoryOpen = !categoryOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span :class="categoryId ? 'text-slate-700' : 'text-slate-400'" x-text="selectedCategoryName"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain" 
                                            :class="categoryOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100 max-h-48 overflow-y-auto">
                                        @foreach($categories ?? [] as $cat)
                                            <div @click="categoryId = '{{ $cat->id }}'; selectedCategoryName = '{{ $cat->category_name ?? $cat->name }}'; categoryOpen = false;" 
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer"
                                                :class="categoryId == '{{ $cat->id }}' ? 'font-semibold' : ''">
                                                {{ $cat->category_name ?? $cat->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Amount -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Stock Amount</label>
                            <input type="number" name="stock" min="0" max="999999" oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);" required value="0" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Buy Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Buy Price</label>
                            <input type="number" name="buy_price" min="0" max="9999999999" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" required placeholder="Rp 0" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Sell Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Sell Price</label>
                            <input type="number" name="sell_price" min="0" max="9999999999" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" required placeholder="Rp 0" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>
                    </div>

                    <!-- Status Dropdown -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status</label>
                        <input type="hidden" name="status" x-model="selectedStatus" required>
                        
                        <div class="relative w-full" @click.away="statusOpen = false">
                            <button type="button" 
                                @click="statusOpen = !statusOpen" 
                                class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none cursor-pointer">
                                <span x-text="selectedStatus"></span>
                                <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                    alt="Arrow" 
                                    class="w-2.5 h-2.5 object-contain"
                                    :class="statusOpen ? 'rotate-180' : 'rotate-0'">
                            </button>

                            <div x-show="statusOpen" 
                                x-cloak
                                class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                <div @click="statusOpen = !statusOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                    <span x-text="selectedStatus"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                        alt="Arrow" 
                                        class="w-2.5 h-2.5 object-contain" 
                                        :class="statusOpen ? 'rotate-180' : 'rotate-0'">
                                </div>
                                <div class="py-1 border-slate-100">
                                    <div @click="selectedStatus = 'Available'; statusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedStatus == 'Available' ? 'font-semibold' : ''">Available</div>
                                    <div @click="selectedStatus = 'Low stock'; statusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedStatus == 'Low stock' ? 'font-semibold' : ''">Low stock</div>
                                    <div @click="selectedStatus = 'Inden'; statusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedStatus == 'Inden' ? 'font-semibold' : ''">Inden</div>
                                    <div @click="selectedStatus = 'Out of stock'; statusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedStatus == 'Out of stock' ? 'font-semibold' : ''">Out of stock</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Product Description -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Description</label>
                            <textarea name="description" rows="4" placeholder="Enter product description" 
                                class="w-full h-[200px] border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-400 focus:outline-none focus:ring-0 focus:border-slate-300 resize-none"></textarea>
                        </div>

                        <!-- Product Image Upload Preview -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Image</label>
                            <label class="group flex flex-col items-center justify-center border border-slate-200 rounded-xl h-[200px] cursor-pointer transition-all relative overflow-hidden">
                                <input type="file" name="image" class="hidden" accept=".jpg, .jpeg, .png, .webp" 
                                    @change="handleImageChange($event)">
                                
                                <template x-if="addPreviewUrl">
                                    <div class="absolute inset-0 w-full h-full">
                                        <img :src="addPreviewUrl" alt="Product Image Preview" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white text-xs font-medium space-y-1">
                                            <img src="{{ asset('icons/pencil.png') }}" alt="Edit" class="w-5 h-5 object-contain invert brightness-0">
                                            <span>Ganti Foto</span>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="!addPreviewUrl">
                                    <div class="flex flex-col items-center space-y-1">
                                        <img src="{{ asset('icons/Upload_pict_icon.png') }}" alt="Upload Icon" class="w-[91px] h-[76px] object-contain">
                                    </div>
                                </template>
                            </label>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="createOpen = false; addPreviewUrl = null;" 
                            class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" 
                            class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm cursor-pointer">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>


    <!-- ================= MODAL EDIT PRODUCT (Teleport ke Body) ================= -->
    <template x-teleport="body">
        <div x-show="editOpen" 
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
            x-data="{ 
                editCategoryOpen: false, 
                editStatusOpen: false, 
                isSwalOpen: false,
                editPreviewUrl: null,
                handleEditImageChange(e) {
                    const file = e.target.files[0];
                    if (!file) {
                        this.editPreviewUrl = null;
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'File Terlalu Besar',
                            text: 'Ukuran foto maksimal adalah 5MB. Silakan pilih foto lain.'
                        });
                        e.target.value = '';
                        this.editPreviewUrl = null;
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        this.editPreviewUrl = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }">
            
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="if (!isSwalOpen) { editOpen = false; editPreviewUrl = null; }">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Edit Product</h3>
                </div>

                <!-- Form Edit -->
                <form :action="editUrl" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Name</label>
                            <input type="text" name="product_name" x-model="selectedProduct.product_name" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Product Code -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Code</label>
                            <input type="text" name="product_code" x-model="selectedProduct.product_code" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Category</label>
                            <input type="hidden" name="category_id" x-model="selectedProduct.category_id" required>
                            
                            <div class="relative" @click.away="editCategoryOpen = false">
                                <button type="button" 
                                    @click="editCategoryOpen = !editCategoryOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none cursor-pointer">
                                    <span class="text-slate-700" x-text="
                                        selectedProduct.category_id ? 
                                        ({
                                            @foreach($categories ?? [] as $cat)
                                                '{{ $cat->id }}': '{{ $cat->category_name ?? $cat->name }}',
                                            @endforeach
                                        }[selectedProduct.category_id] || 'Select Product Category') : 
                                        'Select Product Category'
                                    "></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                        alt="Arrow" 
                                        class="w-2.5 h-2.5 object-contain"
                                        :class="editCategoryOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="editCategoryOpen" 
                                    x-cloak
                                    class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="editCategoryOpen = !editCategoryOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="
                                            selectedProduct.category_id ? 
                                            ({
                                                @foreach($categories ?? [] as $cat)
                                                    '{{ $cat->id }}': '{{ $cat->category_name ?? $cat->name }}',
                                                @endforeach
                                            }[selectedProduct.category_id] || 'Select Product Category') : 
                                            'Select Product Category'
                                        "></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                            alt="Arrow" 
                                            class="w-2.5 h-2.5 object-contain" 
                                            :class="editCategoryOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100 max-h-48 overflow-y-auto">
                                        @foreach($categories ?? [] as $cat)
                                            <div @click="selectedProduct.category_id = '{{ $cat->id }}'; editCategoryOpen = false;" 
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer"
                                                :class="selectedProduct.category_id == '{{ $cat->id }}' ? 'font-semibold' : ''">
                                                {{ $cat->category_name ?? $cat->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Amount -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Stock Amount</label>
                            <input type="number" name="stock" x-model="selectedProduct.stock" min="0" max="999999" oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Buy Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Buy Price</label>
                            <input type="number" name="buy_price" x-model="selectedProduct.buy_price" min="0" max="9999999999" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Sell Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Sell Price</label>
                            <input type="number" name="sell_price" x-model="selectedProduct.sell_price" min="0" max="9999999999" oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>
                    </div>

                    <!-- Status Dropdown -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Status</label>
                        <input type="hidden" name="status" x-model="selectedProduct.status" required>
                        
                        <div class="relative w-full" @click.away="editStatusOpen = false">
                            <button type="button" 
                                @click="editStatusOpen = !editStatusOpen" 
                                class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none cursor-pointer">
                                <span x-text="selectedProduct.status || 'Select Status'"></span>
                                <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                    alt="Arrow" 
                                    class="w-2.5 h-2.5 object-contain"
                                    :class="editStatusOpen ? 'rotate-180' : 'rotate-0'">
                            </button>

                            <div x-show="editStatusOpen" 
                                x-cloak
                                class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                <div @click="editStatusOpen = !editStatusOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                    <span x-text="selectedProduct.status || 'Select Status'"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                        alt="Arrow" 
                                        class="w-2.5 h-2.5 object-contain" 
                                        :class="editStatusOpen ? 'rotate-180' : 'rotate-0'">
                                </div>
                                <div class="py-1 border-slate-100">
                                    <div @click="selectedProduct.status = 'Available'; editStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedProduct.status == 'Available' ? 'font-semibold' : ''">Available</div>
                                    <div @click="selectedProduct.status = 'Low stock'; editStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedProduct.status == 'Low stock' ? 'font-semibold' : ''">Low stock</div>
                                    <div @click="selectedProduct.status = 'Inden'; editStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedProduct.status == 'Inden' ? 'font-semibold' : ''">Inden</div>
                                    <div @click="selectedProduct.status = 'Out of stock'; editStatusOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedProduct.status == 'Out of stock' ? 'font-semibold' : ''">Out of stock</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <!-- Product Description -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Description</label>
                            <textarea name="description" x-model="selectedProduct.description" rows="4" 
                                class="w-full h-[200px] border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-400 focus:outline-none focus:ring-0 focus:border-slate-300 resize-none"></textarea>
                        </div>

                        <!-- Product Image Upload Preview -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Product Image</label>
                            <label class="group flex flex-col items-center justify-center border border-slate-200 rounded-xl h-[200px] cursor-pointer transition-all relative overflow-hidden">
                                <input type="file" name="image" class="hidden" accept=".jpg, .jpeg, .png, .webp" 
                                    @change="handleEditImageChange($event)">
                                
                                <!-- 1. Preview foto baru jika user memilih file baru -->
                                <template x-if="editPreviewUrl">
                                    <div class="absolute inset-0 w-full h-full">
                                        <img :src="editPreviewUrl" alt="New Image Preview" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white text-xs font-medium space-y-1">
                                            <img src="{{ asset('icons/pencil.png') }}" alt="Edit" class="w-5 h-5 object-contain invert brightness-0">
                                            <span>Change Image</span>
                                        </div>
                                    </div>
                                </template>

                                <!-- 2. Foto produk saat ini jika belum memilih file baru dan produk punya foto -->
                                <template x-if="!editPreviewUrl && selectedProduct.image">
                                    <div class="absolute inset-0 w-full h-full">
                                        <img :src="selectedProduct.image_url || ('{{ asset('storage') }}/' + selectedProduct.image)" alt="Current Product Image" class="w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center text-white text-xs font-medium space-y-1">
                                            <img src="{{ asset('icons/pencil.png') }}" alt="Edit" class="w-5 h-5 object-contain invert brightness-0">
                                            <span>Change Image</span>
                                        </div>
                                    </div>
                                </template>

                                <!-- 3. Placeholder upload jika belum ada foto produk dan belum ada file baru -->
                                <template x-if="!editPreviewUrl && !selectedProduct.image">
                                    <div class="flex flex-col items-center space-y-1">
                                        <img src="{{ asset('icons/Upload_pict_icon.png') }}" alt="Upload Icon" class="w-[91px] h-[76px] object-contain">
                                    </div>
                                </template>
                            </label>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="editOpen = false; editPreviewUrl = null;" 
                            class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">
                            Cancel
                        </button>

                        <button type="button" @click.stop.prevent="
                            isSwalOpen = true;
                            Swal.mixin({
                                customClass: {
                                    confirmButton: 'bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg mx-1',
                                    cancelButton: 'bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg mx-1'
                                },
                                buttonsStyling: false
                            }).fire({
                                title: 'Are you sure?',
                                text: 'You won\'t be able to revert this!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Yes, delete it!',
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true,
                                returnFocus: false,
                                didClose: () => {
                                    setTimeout(() => { isSwalOpen = false; }, 100);
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const form = document.getElementById('globalDeleteForm');
                                    form.action = deleteUrl;
                                    form.submit();
                                }
                            });
                        " class="w-20 h-8 flex items-center justify-center border border-[#DC2626] text-[#DC2626] hover:bg-[#DC2626]/5 rounded-[5px] text-xs font-medium transition-colors cursor-pointer">
                            Delete
                        </button>
                        
                        <button type="submit" 
                            class="w-20 h-8 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 border border-transparent text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm cursor-pointer">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>

    <!-- Hidden Form Global Delete -->
    <form id="globalDeleteForm" x-ref="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    timer: 2500,
                    showConfirmButton: false
                });
            });
        </script>
    @endif

    @if(isset($errors) && $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: '{!! implode("<br>", $errors->all()) !!}'
                });
            });
        </script>
    @endif

</div>
@endsection