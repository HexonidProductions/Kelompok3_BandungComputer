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
                <div class="flex flex-col items-center justify-center text-center w-full">
                    {{-- Logo Container (Menggunakan Gambar) --}}
                    <div class="flex justify-center items-center w-full mb-8">
                    {{-- Ganti 'icons/logo.png' dengan nama file logo Anda di folder public --}}
                    <img src="{{ asset('icons/logo_bandung_computer.png') }}" alt="Bandung Computer Logo" class="w-[225px] h-[126px] pr-4 object-contain mx-auto block">
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

        {{-- Remember Me & Forgot Password --}}
        <div class="flex items-center justify-between text-xs pt-1">
            {{-- Checkbox Remember Me --}}
            <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                <input id="remember_me" 
                    type="checkbox" 
                    name="remember"
                    class="w-4 h-4 rounded-sm border-gray-300 text-[#0D47A1] shadow-sm hover:bg-gray-300 focus:ring-0 focus:ring-offset-0 focus:outline-none transition-colors cursor-pointer">
                <span class="ml-2 text-[#0F172A] font-medium">{{ __('Remember me') }}</span>
            </label>

            {{-- Forgot Password Link --}}
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                    class="text-xs text-[#000000] hover:text-[#2563EB] font-semibold transition-colors">
                    {{ __('Forgot Password?') }}
                </a>
            @endif
        </div>

        {{-- Login Button --}}
        <div class="pt-2">
            <button type="submit" class="w-full h-11 bg-[#0D47A1] hover:bg-[#F8FAFC] text-[#F8FAFC] hover:text-[#0D47A1] hover:ring-1 hover:ring-[#0D47A1] focus:outline-none font-semibold text-sm rounded-xl shadow-md transition-all flex items-center justify-center">
                {{ __('Login') }}
            </button>
        </div>

        {{-- Separator --}}
        <div class="flex items-center space-x-3 py-1">
            <div class="flex-grow border-t border-[#0F172A]"></div>
            <span class="text-xs text-[#0F172A] font-normal">OR</span>
            <div class="flex-grow border-t border-[#0F172A]"></div>
        </div>

        {{-- Social Login Button (Google) --}}
        <div>
            <button type="button" class="w-full h-11 flex items-center justify-center gap-2.5 text-xs bg-white text-gray-700 font-medium border border-[#448AFF] rounded-xl shadow-lg hover:shadow-none transition-all">
                <img src="{{ asset('icons/material-icon-theme_google.png')}}" alt="Google Icon" class="w-8 h-8 object-contain">
                Continue with google
            </button>
        </div>
    </form>
</div>

            {{-- Bottom Row: Sign Up Link --}}
            <div class="flex justify-center text-sm text-gray-600 space-x-1">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-[#0F172A] hover:underline font-semibold">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>