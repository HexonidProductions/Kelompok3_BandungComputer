@extends('layouts.app')

@section('content')
<div class="space-y-6" x-data="{ 
    createOpen: false, 
    editOpen: false, 
    editUrl: '', 
    deleteUrl: '',
    selectedUser: {} 
}">

    <!-- Header & Action Bar -->
    <div class="space-y-4">
        <!-- Page Title -->
        <h1 class="text-2xl font-medium text-slate-900">Users</h1>

        <!-- Search Bar, Role Filter & Add User Button -->
        <div class="flex flex-wrap justify-between items-center gap-4">
            <!-- Container Kiri: Search & Role Filter -->
            <div class="flex flex-wrap items-center gap-3">
                <!-- Search Form -->
                <form action="{{ route('users.index') }}" method="GET" class="relative w-72">
                    @if(request('role'))
                        <input type="hidden" name="role" value="{{ request('role') }}">
                    @endif
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{ asset('icons/ci_search-magnifying-glass.png') }}" alt="Search" class="w-4 h-4">
                    </div>
                    <input type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search username" 
                        class="w-full pl-9 pr-3 py-2 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-600 focus:outline-none focus:ring-0 focus:border-slate-300">
                </form>

                <!-- Role Custom Dropdown (Fix Box dengan Absolute Overlay) -->
                <div class="relative inline-block text-left min-w-[160px]" x-data="{ open: false }" @click.away="open = false">
                    <!-- Tombol Utama (Ukuran Fix) -->
                    <button type="button" 
                        @click="open = !open" 
                        class="inline-flex items-center justify-between gap-3 w-full px-3 py-2 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300 cursor-pointer shadow-sm">
                        <span>
                            @if(request('role'))
                                Role: {{ request('role') }}
                            @else
                                Role: All
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
                        
                        <!-- Header tiruan di dalam box (Sudah pakai animasi putar balik) -->
                        <div @click="open = !open" class="h-9 flex items-center justify-between px-3.5 cursor-pointer">
                            <span>
                                @if(request('role'))
                                    Role: {{ request('role') }}
                                @else
                                    Role: All
                                @endif
                            </span>
                            <img src="{{ asset('icons/Vector_option_arrow.png') }}" 
                                alt="Arrow" 
                                class="w-2.5 h-2.5 object-contain"
                                :class="open ? 'rotate-180' : 'rotate-0'">
                        </div>

                        <!-- Daftar Pilihan -->
                        <div class="py-1 border-slate-100">
                            <a href="{{ request()->fullUrlWithQuery(['role' => '']) }}" 
                                class="block px-3.5 py-2.5 transition-colors {{ request('role') == '' ? 'font-semibold' : null }}">
                                Role: All
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['role' => 'Admin']) }}" 
                                class="block px-3.5 py-2.5 transition-colors {{ request('role') == 'Admin' ? 'font-semibold' : null }}">
                                Role: Admin
                            </a>
                            <a href="{{ request()->fullUrlWithQuery(['role' => 'Customer']) }}" 
                                class="block px-3.5 py-2.5 transition-colors {{ request('role') == 'Customer' ? 'font-semibold' : null }}">
                                Role: Customer
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add User Button -->
            <button type="button" 
                @click="createOpen = true" 
                class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-4 py-2 rounded-lg shadow-sm transition-all cursor-pointer">
                <img src="{{ asset('icons/plus_icon.png') }}" alt="Add User" class="w-4 h-4 object-contain"> Add User
            </button>   
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
        <div class="mb-4">
            <h3 class="text-base font-bold text-slate-800">User List</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 text-slate-700 text-xs font-semibold">
                        <th class="py-3 px-3 rounded-l-lg">Name</th>
                        <th class="py-3 px-3">Email</th>
                        <th class="py-3 px-3">Password</th>
                        <th class="py-3 px-3">Phone Number</th>
                        <th class="py-3 px-3">Address</th>
                        <th class="py-3 px-3">Role</th>
                        <th class="py-3 px-3 rounded-r-lg text-center w-16">Action</th>
                    </tr>
                </thead>
                <tbody class="text-xs text-slate-700 font-medium divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr>
                            <td class="py-3.5 px-3 font-bold text-slate-900 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-600">{{ $user->email }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-500 font-inter text-[11px]">{{ Str::limit($user->password, 25) }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-slate-600">{{ $user->phone_number ?? '-' }}</td>
                            <td class="py-3.5 px-3 text-slate-700 max-w-[180px] truncate leading-relaxed text-[11px]" title="{{ $user->address }}">{{ $user->address ?? '-' }}</td>
                            <td class="py-3.5 px-3 whitespace-nowrap font-semibold">
                                <span class="px-2.5 py-1 text-[11px]">{{ $user->role }}</span>
                            </td>
                            <td class="py-3.5 px-3 text-center">
                                <button type="button" 
                                    @click="
                                        editUrl = '{{ route('users.update', $user->id) }}';
                                        deleteUrl = '{{ route('users.destroy', $user->id) }}';
                                        selectedUser = {{ json_encode($user) }};
                                        editOpen = true;
                                    "
                                    class="inline-flex items-center justify-center p-1 rounded-lg transition-all cursor-pointer hover:bg-slate-100"
                                    title="User Options">
                                    <img src="{{ asset('icons/3_dots_icon.png') }}" alt="Options" class="w-4 h-4 object-contain">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->count() > 0)
            <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                <div>Showing {{ $users->firstItem() }}-{{ $users->lastItem() }} out of {{ $users->total() }} Users</div>
                <div>{{ $users->links('components.pagination') }}</div>
            </div>
        @endif
    </div>


    <!-- ================= MODAL ADD USER ================= -->
    <template x-teleport="body">
        <div x-show="createOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="createOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Add New User</h3>
                    <button @click="createOpen = false" class="text-slate-400 hover:text-slate-600 text-lg font-bold cursor-pointer">&times;</button>
                </div>

                <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Name</label>
                            <input type="text" name="name" required placeholder="Enter full name" value="{{ old('name') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" required placeholder="Enter email address" value="{{ old('email') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Password</label>
                            <input type="password" name="password" required placeholder="Enter password" 
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Phone Number</label>
                            <input type="text" name="phone_number" placeholder="Enter phone number" value="{{ old('phone_number') }}"
                                class="w-full h-10 border border-slate-200 rounded-lg px-3.5 text-xs text-slate-700 focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Role Dropdown Add Modal -->
                        <div class="md:col-span-2" x-data="{ createRoleOpen: false, createRoleValue: '', createRoleName: 'Select User Role' }">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Role</label>
                            <input type="hidden" name="role" x-model="createRoleValue" required>
                            
                            <div class="relative" @click.away="createRoleOpen = false">
                                <button type="button" 
                                    @click="createRoleOpen = !createRoleOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span class="text-slate-700" x-text="createRoleName"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="createRoleOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="createRoleOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="createRoleOpen = !createRoleOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="createRoleName"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="createRoleOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        <div @click="createRoleValue = 'Admin'; createRoleName = 'Admin'; createRoleOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="createRoleValue == 'Admin' ? 'font-semibold' : ''">Admin</div>
                                        <div @click="createRoleValue = 'Customer'; createRoleName = 'Customer'; createRoleOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="createRoleValue == 'Customer' ? 'font-semibold' : ''">Customer</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Address</label>
                            <textarea name="address" rows="3" placeholder="Enter address" 
                                class="w-full px-3.5 py-2.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-400 focus:outline-none focus:ring-0 focus:border-slate-300 resize-none">{{ old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="createOpen = false" class="w-20 h-9 flex items-center justify-center border border-slate-800 rounded-[5px] text-xs font-medium text-slate-800 hover:bg-slate-100 transition-colors cursor-pointer">Cancel</button>
                        <button type="submit" class="w-20 h-9 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm cursor-pointer">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </template>


    <!-- ================= MODAL EDIT USER ================= -->
    <template x-teleport="body">
        <div x-show="editOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-white/10 backdrop-blur-[1px] p-4 transition-all">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-xl p-6 relative max-h-[90vh] overflow-y-auto" @click.away="editOpen = false">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-slate-900">Edit User</h3>
                    <button @click="editOpen = false" class="text-slate-400 hover:text-slate-600 text-lg font-bold cursor-pointer">&times;</button>
                </div>

                <form :action="editUrl" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Name</label>
                            <input type="text" name="name" x-model="selectedUser.name" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" x-model="selectedUser.email" required 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Password <span class="text-[10px] text-slate-400 font-normal">(Leave blank if unchanged)</span></label>
                            <input type="password" name="password" placeholder="New password" 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Phone Number</label>
                            <input type="text" name="phone_number" x-model="selectedUser.phone_number" 
                                class="w-full h-10 px-3.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white focus:outline-none focus:ring-0 focus:border-slate-300">
                        </div>

                        <!-- Role Dropdown Edit Modal -->
                        <div class="md:col-span-2" x-data="{ editRoleOpen: false }">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Role</label>
                            <input type="hidden" name="role" x-model="selectedUser.role" required>
                            
                            <div class="relative" @click.away="editRoleOpen = false">
                                <button type="button" 
                                    @click="editRoleOpen = !editRoleOpen" 
                                    class="w-full h-10 inline-flex items-center justify-between border border-slate-200 rounded-lg text-xs bg-white px-3.5 text-slate-700 focus:outline-none shadow-sm cursor-pointer">
                                    <span class="text-slate-700" x-text="selectedUser.role || 'Select User Role'"></span>
                                    <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editRoleOpen ? 'rotate-180' : 'rotate-0'">
                                </button>

                                <div x-show="editRoleOpen" x-cloak class="absolute top-0 left-0 right-0 bg-white border border-slate-200 rounded-lg shadow-lg z-50 text-xs text-slate-700">
                                    <div @click="editRoleOpen = !editRoleOpen" class="h-10 flex items-center justify-between px-3.5 cursor-pointer">
                                        <span class="text-slate-700" x-text="selectedUser.role || 'Select User Role'"></span>
                                        <img src="{{ asset('icons/Vector_option_arrow.png') }}" alt="Arrow" class="w-2.5 h-2.5 object-contain" :class="editRoleOpen ? 'rotate-180' : 'rotate-0'">
                                    </div>
                                    <div class="py-1 border-slate-100">
                                        <div @click="selectedUser.role = 'Admin'; editRoleOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedUser.role == 'Admin' ? 'font-semibold' : ''">Admin</div>
                                        <div @click="selectedUser.role = 'Customer'; editRoleOpen = false;" class="px-3.5 py-2.5 transition-colors cursor-pointer" :class="selectedUser.role == 'Customer' ? 'font-semibold' : ''">Customer</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Address</label>
                            <textarea name="address" x-model="selectedUser.address" rows="3" 
                                class="w-full px-3.5 py-2.5 border border-slate-200 rounded-lg text-xs text-slate-700 bg-white placeholder-slate-400 focus:outline-none focus:ring-0 focus:border-slate-300 resize-none"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end items-center gap-3 pt-4 border-slate-100 mt-6">
                        <button type="button" @click="editOpen = false" class="w-20 h-9 flex items-center justify-center border border-slate-300 rounded-[5px] text-xs font-medium text-slate-700 hover:bg-slate-50 transition-colors cursor-pointer">Cancel</button>
                        <button type="button" @click="
                            if(confirm('Are you sure you want to delete this user?')) {
                                $refs.globalDeleteForm.action = deleteUrl;
                                $refs.globalDeleteForm.submit();
                            }
                        " class="w-20 h-9 flex items-center justify-center border border-[#DC2626] text-[#DC2626] hover:bg-[#DC2626]/5 rounded-[5px] text-xs font-medium transition-colors cursor-pointer">Delete</button>
                        <button type="submit" class="w-20 h-9 flex items-center justify-center bg-[#2563EB] hover:bg-blue-700 text-white rounded-[5px] text-xs font-medium transition-colors shadow-sm cursor-pointer">Save</button>
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