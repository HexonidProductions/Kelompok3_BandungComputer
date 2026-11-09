{{-- resources/views/auth/login.blade.php --}}

<x-guest-layout>
    {{-- Main Container Locked to 100vh --}}
    <div class="h-screen w-screen overflow-hidden flex flex-col md:flex-row bg-[#F8FAFC]">

        {{-- Left Side: Image Panel (md and up) --}}
        <div class="hidden md:flex md:w-1/2 h-full bg-[#F8FAFC] justify-center items-center overflow-hidden p-2 lg:p-3">
            <img src="{{ asset('images/banner_login_page_revision.png') }}" alt="Banner Image" class="w-full h-full object-cover rounded-2xl">
        </div>

        {{-- Right Side: Form Panel --}}
        <div class="w-full md:w-1/2 h-full bg-[#F8FAFC] px-6 py-4 md:px-12 md:py-6 flex flex-col justify-between overflow-hidden">
            
            {{-- Top Row: Header --}}
            <div class="flex flex-col space-y-3 lg:space-y-4">
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
                    <div class="flex justify-center items-center w-full mb-2">
                        <img src="{{ asset('icons/logo_bandung_computer.png') }}" alt="Bandung Computer Logo" class="w-[180px] lg:w-[210px] h-auto pr-4 object-contain mx-auto block">
                    </div>
                    {{-- Welcome Text --}}
                    <h1 class="text-2xl lg:text-4xl font-bold text-[#0F172A]">Welcome Back</h1>
                    <p class="text-xs lg:text-sm text-[#0F172A] text-center max-w-[250px] leading-snug mt-1">
                        Elevate your digital lifestyle with the latest tech and gadgets.
                    </p>
                </div>
            </div>

            {{-- Middle Row: Form --}}
            <div class="w-full pb-4">
                <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm mx-auto space-y-3 lg:space-y-4">
                    @csrf

                    {{-- Email Address --}}
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-xs lg:text-sm font-medium text-[#0F172A] mb-1" />
                        <div class="relative">
                            <input id="email" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    required autofocus autocomplete="username" 
                                    placeholder="Enter Your Email"
                                    class="block w-full h-10 lg:h-11 px-4 pr-10 text-sm bg-white text-gray-800 border-2 border-gray-200 rounded-xl focus:border-gray-300 focus:ring-0 focus:outline-none placeholder-gray-400 transition-colors">
                            
                            {{-- Input Icon --}}
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <img src="{{ asset('icons/mdi_user.png')}}" alt="Email Icon" class="w-5 h-5 object-contain">
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    {{-- Password --}}
                    <div x-data="{ isHidden: true }">
                        <x-input-label for="password" :value="__('Password')" class="text-xs lg:text-sm font-medium text-[#0F172A] mb-1" />
                        <div class="relative">
                            <input id="password" 
                                    :type="isHidden ? 'password' : 'text'" 
                                    name="password" 
                                    required autocomplete="current-password" 
                                    placeholder="Enter Your Password"
                                    class="block w-full h-10 lg:h-11 px-4 pr-12 text-sm bg-white text-gray-800 border border-gray-200 rounded-xl focus:border-gray-300 focus:ring-0 focus:outline-none transition-colors">
                            
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
                        <button type="submit" class="w-full h-10 lg:h-11 bg-[#0D47A1] hover:bg-[#F8FAFC] text-[#F8FAFC] hover:text-[#0D47A1] hover:ring-1 hover:ring-[#0D47A1] focus:outline-none font-semibold text-sm rounded-xl shadow-md transition-all flex items-center justify-center">
                            {{ __('Login') }}
                        </button>
                    </div>

                    {{-- Separator --}}
                    <div class="flex items-center space-x-3 py-0.5">
                        <div class="flex-grow border-t border-[#0F172A]"></div>
                        <span class="text-xs text-[#0F172A] font-normal">OR</span>
                        <div class="flex-grow border-t border-[#0F172A]"></div>
                    </div>

                    {{-- Social Login Button (Google) --}}
                    <div>
                        <a href="{{ route('google.login') }}" class="w-full h-10 lg:h-11 flex items-center justify-center gap-2.5 text-xs bg-white text-gray-700 font-medium border border-[#448AFF] rounded-xl shadow-sm hover:shadow-none transition-all">
                            <img src="{{ asset('icons/material-icon-theme_google.png')}}" alt="Google Icon" class="w-6 h-6 object-contain">
                            Continue with google
                        </a>
                    </div>
                </form>
            </div>

            {{-- Bottom Row: Sign Up Link --}}
            <div class="flex justify-center text-xs lg:text-sm text-gray-600 space-x-1 mb-16">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-[#0F172A] hover:underline font-semibold">
                    Sign up
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>