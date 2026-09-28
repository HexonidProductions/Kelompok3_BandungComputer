{{-- resources/views/auth/login.blade.php --}}

<x-guest-layout>
    {{-- Main Split-Screen Container --}}
    <div class="min-h-screen flex flex-col md:flex-row bg-gray-900">

        {{-- Left Side: Image Panel (md and up) --}}
        <div class="hidden md:flex md:w-1/2 bg-[#F8FAFC] justify-center items-center overflow-hidden p-2 lg:p-3">
            {{-- Ganti 'images/computer_store.jpg' dengan path gambar Anda yang sebenarnya --}}
            <img src="{{ asset('images/banner_login_page.png') }}" alt="Computer Store" class="w-full h-full object-cover rounded-2xl">
        </div>

        {{-- Right Side: Form Panel --}}
        <div class="w-full md:w-1/2 bg-[#F8FAFC] p-6 md:p-12 flex flex-col justify-between">
            
            {{-- Top Row: Header --}}
            <div class="flex flex-col space-y-8">
                {{-- Back Link --}}
                <div class="flex justify-end text-sm text-[#0F172A]">
                <a href="/" class="group inline-flex items-center gap-1 hover:text-[#0D47A1]">
                <span>Back to homepage</span>
                <img src="{{ asset('icons/eva_arrow-ios-back-outline.png') }}" 
                alt="Arrow Icon" 
                class="w-5 h-5 object-contain mt-1 -ml-1 group-hover:[filter:invert(22%)_sepia(88%)_saturate(2811%)_hue-rotate(206deg)_brightness(94%)_contrast(95%)]">
                </a>
                </div>

                {{-- Logo and Welcome Text --}}
                <div class="flex flex-col items-center">
                    {{-- Logo Container (Menggunakan Gambar) --}}
                    <div class="flex flex-col items-center">
                     {{-- Ganti 'icons/logo.png' dengan nama file logo Anda di folder public --}}
                    <img src="{{ asset('icons/logo_bandung_computer.png') }}" alt="Bandung Computer Logo" class="w-[225px] h-[126px] object-contain mb-8">
                    </div>
                    {{-- Welcome Text --}}
                    <h1 class="text-[45px] font-bold text-[#0F172A]">Welcome Back</h1>
                    <p class="text-base text-[#0F172A] text-center max-w-[250px] leading-snug">
                        Elevate your digital lifestyle with the latest tech and gadgets.
                    </p>
                </div>
            </div>

            {{-- Middle Row: Form --}}
            {{-- Middle Row: Form --}}
<div class="py-6 flex-grow flex items-center">
    {{-- max-w-sm (384px) membuat lebar form lebih ringkas dan pas sesuai Figma --}}
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm mx-auto space-y-4">
        @csrf

        {{-- Email Address --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-[#0F172A] mb-1" />
            <div class="relative">
                <input id="email" 
                       type="email" 
                       name="email" 
                       :value="old('email')" 
                       required autofocus autocomplete="username" 
                       placeholder="Enter Your Email"
                       class="block w-full h-11 px-4 pr-10 text-sm bg-white text-gray-800 border-2 border-gray-200 rounded-xl drop-shadow-[0_2px_4px_rgba(0,0,0,0)] focus:border-gray-200 focus:ring-0 focus:outline-none focus:ring-offset-0 placeholder-gray-400 transition-colors">
                
                {{-- Input Icon --}}
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <img src="{{ asset('icons/mdi_user.png')}}" alt="Email Icon" class="w-[25px] h-[25px] object-contain">
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        {{-- Password --}}
<div x-data="{ isHidden: false }">
    <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-[#0F172A] mb-1" />
    <div class="relative">
        {{-- Jika isHidden = true maka type="password", jika false maka type="text" --}}
        <input id="password" 
                :type="isHidden ? 'password' : 'text'" 
                name="password" 
                required autocomplete="current-password" 
                placeholder="Enter Your Password"
                class="block w-full h-11 px-4 pr-12 text-sm bg-white text-gray-800 border border-gray-200 rounded-xl drop-shadow-[0_2px_4px_rgba(0,0,0,0.08)] focus:border-gray-300 focus:ring-0 focus:outline-none transition-colors">
        
        {{-- Tombol Ikon Mata --}}
        <button type="button" 
                @click="isHidden = !isHidden" 
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
            
            {{-- Ikon Mata Terbuka / Tanpa Silang (Tampil saat isHidden = false / Teks Terbaca) --}}
            <img x-show="!isHidden" 
                src="{{ asset('icons/iconoir_eye-solid.png') }}" 
                alt="Show Password" 
                class="w-6 h-6 object-contain">

            {{-- Ikon Mata Disilang (Tampil saat isHidden = true / Password Tersembunyi ••••••) --}}
            <img x-show="isHidden" 
                src="{{ asset('icons/fluent_eye-off-16-filled.png') }}" 
                alt="Hide Password" 
                class="w-6 h-6 object-contain" 
                x-cloak>
        </button>
    </div>
    <x-input-error :messages="$errors->get('password')" class="mt-1" />
</div>
        {{-- Login Button --}}
        <div class="pt-2">
            <button type="submit" class="w-full h-11 bg-[#0D47A1] hover:bg-[#0a3880] text-white font-semibold text-sm rounded-xl shadow-md transition-all flex items-center justify-center">
                {{ __('Login') }}
            </button>
        </div>

        {{-- Separator --}}
        <div class="flex items-center space-x-3 py-1">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="text-xs text-gray-400 font-normal">OR</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        {{-- Social Login Button (Google) --}}
        <div>
            <button type="button" class="w-full h-11 flex items-center justify-center gap-2.5 text-xs bg-white text-gray-700 font-medium border border-gray-200 rounded-xl shadow-sm hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M44.5 20H24V28H35.8C34.7 33.9 29.9 38 24 38C16.3 38 10 31.7 10 24C10 16.3 16.3 10 24 10C27.3 10 30.2 11.2 32.5 13.2L38.2 7.5C34.2 3.8 29.3 1.5 24 1.5C11.6 1.5 1.5 11.6 1.5 24C1.5 36.4 11.6 46.5 24 46.5C36.4 46.5 46.5 36.4 46.5 24C46.5 22.6 46.4 21.3 46.2 20H44.5Z" fill="#EA4335"/>
                    <path d="M44.5 20H24V28H35.8C35.1 31 33.4 33.6 31 35.4L37.1 40.2C40.6 36.8 42.8 32 43.1 27L44.5 20Z" fill="#FBBC05"/>
                    <path d="M10.8 14.7L16.5 20.4C18 16.6 21.3 14 25.1 14C28.3 14 31.2 15.2 33.3 17.2L39 11.5C35.4 8.2 30.6 6 25.1 6C18.6 6 13.1 9.4 10.8 14.7Z" fill="#34A853"/>
                    <path d="M24 46.5C30.6 46.5 36.3 44.3 40.2 40.6L34.1 35.8C31.5 37.6 28.1 38.6 24 38.6C17.5 38.6 12 34.2 10.1 28.2L4.3 32.6C7.6 40.9 15.3 46.5 24 46.5Z" fill="#4285F4"/>
                </svg>
                Continue with google
            </button>
        </div>
    </form>
</div>

            {{-- Bottom Row: Sign Up Link --}}
            <div class="flex justify-center text-sm text-gray-600 space-x-1">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-900 font-semibold">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>