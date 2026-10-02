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
            <a href="{{ route('dashboard') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/Overview_icon.png')}}" alt="Overview Icon" class="w-4 h-4 object-contain">
                <span>Overview</span>
            </a>

            <a href="{{ route('categories.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('categories.*') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/Categories_icon.png')}}" alt="Categories Icon" class="w-4 h-4 object-contain">
                <span>Categories</span>
            </a>

            <a href="{{ route('transactions.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('transactions.*') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/Transactions_icon.png')}}" alt="Transactions Icon" class="w-4 h-4 object-contain">
                <span>Transactions</span>
            </a>

            <a href="{{ route('products.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('products.*') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/Products_icon.png')}}" alt="Products Icon" class="w-4 h-4 object-contain">
                <span>Products</span>
            </a>

            <a href="{{ route('users.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('users.*') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/Users_icon.png')}}" alt="Users Icon" class="w-4 h-4 object-contain">
                <span>Users</span>
            </a>

            <a href="{{ route('suppliers.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('suppliers.*') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/Suppliers_icon.png')}}" alt="Suppliers Icon" class="w-4 h-4 object-contain">
                <span>Suppliers</span>
            </a>

            <a href="{{ route('daily-closings.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-none text-xs font-normal text-white transition-all duration-150 {{ request()->routeIs('daily-closings.*') ? 'bg-[#2563EB] text-white' : 'text-slate-400 hover:bg-slate-800/60 hover:text-white' }}">
                <img src="{{ asset('icons/DailyClosings_icon.png')}}" alt="Daily Closings Icon" class="w-4 h-4 object-contain">
                <span>Daily Closing</span>
            </a>
        </nav>
    </div>

    <!-- Bagian Bawah: Profile Info & Logout -->
    <div class="p-4">
        <p class="text-[10px] font-normal tracking-wider mb-0.5">Admin</p>
        <h4 class="text-xs font-bold text-white truncate mb-2.5">{{ Auth::user()->name }}</h4>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-[#0D47A1] hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg text-xs transition-colors flex items-center justify-center gap-2 shadow-sm">
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>