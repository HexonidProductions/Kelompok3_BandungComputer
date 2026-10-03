@extends('layouts.app')

@section('content')
<div x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '', 
    categoryName: '' 
}" class="space-y-6">

    <!-- Header & Action Bar -->
    <div class="space-y-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-medium text-slate-900">Category</h1>

        <!-- Search Bar & Add Category Button -->
        <div class="flex justify-between items-center gap-4">
            <!-- Search Input -->
            <form action="{{ route('categories.index') }}" method="GET" class="relative w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <img src="{{ asset('icons/ci_search-magnifying-glass.png')}}" alt="Search Icon" class="w-4 h-4">
                </div>
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search category" 
                    class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-900 focus:outline-none focus:ring-0 focus:border-slate-300">
            </form>

            <!-- Add Category Button -->
            <button type="button" 
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all">
                <span>+</span> Add Category
            </button>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <!-- Table Title -->
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">Category List</h3>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-4 rounded-l-lg w-16">No.</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4 rounded-r-lg w-28 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="py-3.5 px-4 font-normal text-slate-600">
                                {{ $categories->firstItem() + $index }}
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-slate-900">
                                {{ $category->category_name }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit Button -->
                                    <button type="button" 
                                        @click="
                                            editUrl = '{{ route('categories.update', $category->id) }}';
                                            categoryName = '{{ addslashes($category->category_name) }}';
                                            editOpen = true;
                                        "
                                        class="p-1 text-slate-500 hover:text-slate-800 transition-colors"
                                        title="Edit Category">
                                        <img src="{{ asset('icons/pencil.png')}}" alt="Edit Icon" class="w-4 h-4 object-contain">
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" 
                                        @click="
                                            deleteUrl = '{{ route('categories.destroy', $category->id) }}';
                                            if (confirm('Are you sure you want to delete category {{ addslashes($category->category_name) }}?')) {
                                                $refs.globalDeleteForm.action = deleteUrl;
                                                $refs.globalDeleteForm.submit();
                                            }
                                        "
                                        class="p-1 text-red-400 hover:text-red-600 transition-colors"
                                        title="Delete Category">
                                        <img src="{{ asset('icons/trash.png')}}" alt="Delete Icon" class="w-4 h-4 object-contain">
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-8 text-center text-slate-400">
                                No categories available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer & Pagination -->
        @if($categories->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>
                    Showing {{ $categories->firstItem() }}-{{ $categories->lastItem() }} out of {{ $categories->total() }} Category
                </div>
                <div>
                    {{ $categories->links('components.pagination') }}
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
            <!-- Modal Add Category -->
            <div x-show="createOpen" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
                @keydown.escape.window="createOpen = false">

                <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative" @click.away="createOpen = false">
                    <h3 class="text-base font-bold text-slate-900 mb-5">Add New Category</h3>

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Category Name</label>
                            <input type="text" 
                                name="category_name" 
                                required 
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300"
                                placeholder="Enter category name">
                        </div>

                        <div class="flex items-center justify-end gap-2.5">
                            <button type="button" 
                                @click="createOpen = false" 
                                class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" 
                                class="w-20 h-8 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit Category -->
            <div x-show="editOpen" 
                class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all"
                @keydown.escape.window="editOpen = false">

                <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative" @click.away="editOpen = false">
                    <h3 class="text-base font-bold text-slate-900 mb-5">Edit Category</h3>

                    <form :action="editUrl" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Category Name</label>
                            <input type="text" 
                                name="category_name" 
                                x-model="categoryName" 
                                required 
                                class="w-full border border-slate-200 rounded-lg px-3 py-2 text-xs focus:outline-none focus:ring-0 focus:border-slate-300"
                                placeholder="Enter category name">
                        </div>

                        <div class="flex items-center justify-end gap-2.5">
                            <button type="button" 
                                @click="editOpen = false" 
                                class="w-20 h-8 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" 
                                class="w-20 h-8 flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm">
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