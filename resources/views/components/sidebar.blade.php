<aside class="w-56 bg-[#0F172A] text-white fixed inset-y-0 left-0 flex flex-col justify-between z-50 shadow-xl border-r border-slate-800/80">
    <!-- Bagian Atas: Logo & Menu Navigasi -->
    <div class="pt-4 pb-2 overflow-y-auto">
        <!-- Logo Header -->
        <div class="flex items-center justify-center -mt-1 mb-3 w-full">
            <div class="w-[140px] h-auto flex items-center justify-center mr-6">
                <img src="{{ asset('icons/Logo_bandung_computer_white_(4).png')}}" alt="Bandung Computer Logo" class="w-full h-full object-contain">
            </div>
        </div>

        <!-- Navigation Links (Full-width kotak tanpa lekukan) -->
        <nav class="space-y-0.5">
            <a href="{{ route('dashboard') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Overview_icon.png')}}" alt="Overview Icon" class="w-4 h-4 object-contain">
                <span>Overview</span>
            </a>

            <a href="{{ route('products.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('products.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Products_icon.png')}}" alt="Products Icon" class="w-4 h-4 object-contain">
                <span>Products</span>
            </a>

            <a href="{{ route('transactions.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('transactions.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Transactions_icon.png')}}" alt="Transactions Icon" class="w-4 h-4 object-contain">
                <span>Transactions</span>
            </a>

            <a href="{{ route('categories.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('categories.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Categories_icon.png')}}" alt="Categories Icon" class="w-4 h-4 object-contain">
                <span>Categories</span>
            </a>

            <a href="{{ route('users.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('users.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Users_icon.png')}}" alt="Users Icon" class="w-4 h-4 object-contain">
                <span>Users</span>
            </a>

            <a href="{{ route('contact-messages.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('contact-messages.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Vector (2).png')}}" alt="Feedbacks Icon" class="w-4 h-4 object-contain">
                <span>Feedbacks</span>
            </a>

            <a href="{{ route('suppliers.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('suppliers.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Suppliers_icon.png')}}" alt="Suppliers Icon" class="w-4 h-4 object-contain">
                <span>Suppliers</span>
            </a>


            <a href="{{ route('inventory-logs.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('inventory-logs.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Vector.png')}}" alt="Inventory Logs Icon" class="w-4 h-4 object-contain">
                <span>Inventory Logs</span>
            </a>

            <a href="{{ route('daily-closings.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('daily-closings.*') ? 'bg-[#2563EB]' : null }}">
                <img src="{{ asset('icons/Vector (1).png')}}" alt="Income Reports Icon" class="w-4 h-4 object-contain">
                <span>Income Reports</span>
            </a>
        </nav>
    </div>

    <!-- Bagian Bawah: Profile Info & Logout -->
    <div class="p-4">
        <p class="text-[10px] font-normal tracking-wider mb-0.5">Admin</p>
        <h4 class="text-xs font-bold text-white truncate mb-6">{{ Auth::user()?->name ?? 'Guest' }}</h4>

        <form method="POST" action="{{ route('logout') }}" x-data @submit.prevent="
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will be logged out of your account.',
                icon: 'warning',
                iconColor: '#2563EB',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, logout!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                returnFocus: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $el.submit();
                }
            });
        ">
            @csrf
            <button type="submit" class="w-full h-10 bg-[#0D47A1] hover:bg-[#0b3c8a] text-white font-semibold py-2 px-3 rounded-lg text-xs transition-colors flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>