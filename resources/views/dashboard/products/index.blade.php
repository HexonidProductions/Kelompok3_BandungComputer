@extends('layouts.app')

@section('content')
<div class="space-y-6" x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '',
    selectedProduct: {} 
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
                        class="w-full h-9 inline-flex items-center justify-between gap-3 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white px-3 focus:outline-none shadow-sm cursor-pointer">
                        <span>
                            @if(request('status') == 'Available')
                                Status: Available
                            @elseif(request('status') == 'Low stock')
                                Status: Low stock
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
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all cursor-pointer">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add Product" class="w-4 h-4 object-contain"> Add Product
            </button>   
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
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product" class="w-10 h-10 object-cover">
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
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#16A34A] text-[#000000] bg-white">
                                        Available
                                    </span>
                                @elseif($product->status === 'Low stock')
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#F59E0B] text-[#000000] bg-white">
                                        Low stock
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-md text-[11px] font-semibold border-2 border-[#DC2626] text-[#000000] bg-white">
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
            x-data="{ categoryOpen: false, selectedCategoryName: 'Select Product Category', categoryId: '' }">
            
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="createOpen = false">
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

                        <!-- Category (Fixed Box + Animasi Dua Arah) -->
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
                            <input type="number" name="stock" min="0" required value="0" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Buy Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Buy Price</label>
                            <input type="number" name="buy_price" min="0" required placeholder="Rp 0" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Sell Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Sell Price</label>
                            <input type="number" name="sell_price" min="0" required placeholder="Rp 0" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
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
                            <label class="flex flex-col items-center justify-center border border-slate-200 rounded-xl h-[200px] cursor-pointer transition-all relative overflow-hidden">
                                <input type="file" name="image" class="hidden" accept="image/*" @change="const file = $event.target.files[0]; if(file){ $refs.previewAdd.src = URL.createObjectURL(file); $refs.previewAdd.classList.remove('hidden'); }">
                                <img x-ref="previewAdd" class="hidden absolute inset-0 w-full h-full object-cover">
                                <div class="flex flex-col items-center space-y-1">
                                    <img src="{{ asset('icons/Product_image_icon.png') }}" alt="Product Image" class="w-[50px] h-[50px] object-contain">
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Footer Buttons -->
                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="createOpen = false" 
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
            x-data="{ editCategoryOpen: false }">
            
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="editOpen = false">
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

                        <!-- Category (Fixed Box + Animasi Dua Arah) -->
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
                                                class="px-3.5 py-2.5 transition-colors cursor-pointer hover:bg-slate-50"
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
                            <input type="number" name="stock" x-model="selectedProduct.stock" min="0" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Buy Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Buy Price</label>
                            <input type="number" name="buy_price" x-model="selectedProduct.buy_price" min="0" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        </div>

                        <!-- Sell Price -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Sell Price</label>
                            <input type="number" name="sell_price" x-model="selectedProduct.sell_price" min="0" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
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
                            <label class="flex flex-col items-center justify-center border border-slate-200 rounded-xl h-[200px] cursor-pointer transition-all relative overflow-hidden">
                                <input type="file" name="image" class="hidden" accept="image/*" @change="const file = $event.target.files[0]; if(file){ $refs.previewEdit.src = URL.createObjectURL(file); $refs.previewEdit.classList.remove('hidden'); }">
                                <img x-ref="previewEdit" class="hidden absolute inset-0 w-full h-full object-cover z-10">
                                <template x-if="selectedProduct.image">
                                    <img src="{{ asset('icons/Product_image_icon.png') }}" alt="Product Image" class="w-[50px] h-[50px] object-contain">
                                </template>
                            </label>
                        </div>
                    </div>

                    <!-- Footer Buttons: Cancel, Delete, Save (Rata Kanan) -->
                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="editOpen = false" 
                            class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">
                            Cancel
                        </button>

                        <button type="button" @click="
                            if(confirm('Are you sure you want to delete this product?')) {
                                $refs.globalDeleteForm.action = deleteUrl;
                                $refs.globalDeleteForm.submit();
                            }
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
    <form x-ref="globalDeleteForm" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

</div>
@endsection