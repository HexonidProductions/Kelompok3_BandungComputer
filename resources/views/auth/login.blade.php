{{-- resources/views/auth/login.blade.php --}}

<x-guest-layout>
    {{-- Main Container Locked to 100vh --}}
    <div class="h-screen w-screen overflow-hidden flex flex-col md:flex-row bg-[#F8FAFC]">

        {{-- Left Side: Image Panel (Gambar Penuh Memenuhi Panel Tanpa Celah Putih) --}}
        <div class="hidden md:flex md:w-1/2 h-full bg-[#F8FAFC] p-3 lg:p-4">
            <img src="{{ asset('images/banner_login_page_revision.png') }}" 
                 alt="Banner Image" 
                 class="w-full h-full object-cover rounded-3xl shadow-sm">
        </div>

        {{-- Right Side: Form Panel --}}
        <div class="w-full md:w-1/2 h-full bg-[#F8FAFC] px-6 py-4 md:px-12 md:py-6 flex flex-col justify-between overflow-hidden">
            
            {{-- Top Row: Header --}}
            <div class="flex flex-col space-y-2 lg:space-y-3 pt-1">
                {{-- Back Link --}}
                <div class="flex justify-end text-sm text-[#0F172A]">
                    <a href="{{ route('homepage') }}" class="group inline-flex items-center gap-1 hover:text-[#0D47A1]">
                        <span>Back to homepage</span>
                        <img src="{{ asset('icons/eva_arrow-ios-back-outline.png') }}" 
                             alt="Arrow Icon" 
                             class="w-5 h-5 object-contain mt-1 -ml-1 group-hover:[filter:invert(22%)_sepia(88%)_saturate(2811%)_hue-rotate(206deg)_brightness(94%)_contrast(95%)]">
                    </a>
                </div>

                {{-- Logo and Welcome Text --}}
                <div class="flex flex-col items-center justify-center text-center w-full">
                    {{-- Logo Container --}}
                    <div class="flex justify-center items-center w-full mb-1">
                        <img src="{{ asset('icons/logo_bandung_computer.png') }}" alt="Bandung Computer Logo" class="w-[170px] lg:w-[200px] h-auto object-contain mx-auto block">
                    </div>
                    {{-- Welcome Text --}}
                    <h1 class="text-2xl lg:text-3xl font-extrabold text-[#0F172A] tracking-tight">Welcome Back</h1>
                    <p class="text-xs lg:text-sm text-slate-500 text-center max-w-[250px] leading-snug mt-1">
                        Elevate your digital lifestyle with the latest tech and gadgets.
                    </p>
                </div>
            </div>

            {{-- Middle Row: Form --}}
            <div class="w-full my-auto">
                <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm mx-auto space-y-3">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-xs lg:text-sm font-semibold text-[#0F172A] mb-1" />
                        <div class="relative">
                            <input id="email" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required autofocus autocomplete="username" 
                                    placeholder="Enter Your Email"
                                    class="block w-full h-10 lg:h-11 px-4 pr-10 text-sm bg-white text-gray-800 border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 focus:outline-none placeholder-gray-400 shadow-sm transition-colors">
                            
                            {{-- Input Icon --}}
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <img src="{{ asset('icons/mdi_user.png')}}" alt="Email Icon" class="w-5 h-5 object-contain">
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div x-data="{ isHidden: true }">
                        <x-input-label for="password" :value="__('Password')" class="text-xs lg:text-sm font-semibold text-[#0F172A] mb-1" />
                        <div class="relative">
                            <input id="password" 
                                    :type="isHidden ? 'password' : 'text'" 
                                    name="password" 
                                    required autocomplete="current-password" 
                                    placeholder="Enter Your Password"
                                    class="block w-full h-10 lg:h-11 px-4 pr-12 text-sm bg-white text-gray-800 border border-gray-200 rounded-xl focus:border-blue-500 focus:ring-0 focus:outline-none placeholder-gray-400 shadow-sm transition-colors">
                            
                            {{-- Tombol Ikon Mata --}}
                            <button type="button" 
                                    @click="isHidden = !isHidden" 
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                                
                                <img x-show="!isHidden" 
                                    src="{{ asset('icons/iconoir_eye-solid.png') }}" 
                                    alt="Show Password" 
                                    class="w-5 h-5 object-contain">

                                <img x-show="isHidden" 
                                    src="{{ asset('icons/fluent_eye-off-16-filled.png') }}" 
                                    alt="Hide Password" 
                                    class="w-5 h-5 object-contain" 
                                    x-cloak>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    {{-- Login Button --}}
                    <div class="pt-1">
                        <button type="submit" class="w-full h-10 lg:h-11 bg-[#0D47A1] hover:bg-[#0A3880] text-white font-semibold text-sm rounded-xl shadow-md transition-all flex items-center justify-center">
                            {{ __('Login') }}
                        </button>
                    </div>

                    {{-- Separator --}}
                    <div class="flex items-center space-x-3 py-0.5">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="text-xs text-slate-400 font-medium">OR</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    {{-- Social Login Button (Google) --}}
                    <div>
                        <a href="{{ route('google.login') }}" class="w-full h-10 lg:h-11 flex items-center justify-center gap-2 text-xs bg-white text-slate-700 font-medium border border-blue-400 rounded-xl shadow-sm hover:bg-slate-50 transition-all">
                            <img src="{{ asset('icons/material-icon-theme_google.png')}}" alt="Google Icon" class="w-5 h-5 object-contain">
                            Continue with google
                        </a>
                    </div>
                </form>

                {{-- Bottom Row: Sign Up Link (Berjarak Rapat di Bawah Tombol Google) --}}
                <div class="flex justify-center text-xs lg:text-sm text-slate-600 space-x-1 mt-3">
                    <p>Don't have an account?</p>
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-[#0F172A] hover:underline font-semibold">
                        Sign up
                    </a>
                </div>
            </div>

            {{-- Filler --}}
            <div class="h-2"></div>
        </div>
    </div>
</x-guest-layout>