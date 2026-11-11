{{-- resources/views/components/login-success-overlay.blade.php --}}
<div id="loginSuccessOverlay" 
     class="hidden fixed inset-0 bg-[#1e1e1e] bg-opacity-95 z-[9999] flex items-center justify-center p-4 transition-opacity duration-300">
    <div id="loginSuccessCard" 
         class="w-full max-w-[340px] bg-white rounded-[32px] px-8 py-12 shadow-2xl flex flex-col items-center justify-center text-center transform transition-all duration-300 scale-95 opacity-0">
        
        {{-- Success User Icon with Checkmark --}}
        <div class="w-20 h-20 mb-6 flex items-center justify-center">
            <img src="{{ asset('icons/login_success_icon.svg') }}" alt="Login Berhasil" class="w-20 h-20 object-contain">
        </div>

        {{-- Heading --}}
        <h2 class="text-xl font-bold text-gray-900 mb-2">Anda berhasil login</h2>

        {{-- Subtitle --}}
        <p class="text-xs text-gray-500 leading-relaxed max-w-[240px] mx-auto">
            Selamat datang kembali! Anda akan dialihkan dalam beberapa saat.
        </p>

        {{-- Small Animated Pulse Indicator --}}
        <div class="mt-6 flex items-center justify-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-[#0d47a1] animate-bounce" style="animation-delay: 0ms;"></span>
            <span class="w-2 h-2 rounded-full bg-[#0d47a1] animate-bounce" style="animation-delay: 150ms;"></span>
            <span class="w-2 h-2 rounded-full bg-[#0d47a1] animate-bounce" style="animation-delay: 300ms;"></span>
        </div>
    </div>
</div>

<script>
    function triggerLoginSuccess(redirectUrl, delay = 2500) {
        const overlay = document.getElementById('loginSuccessOverlay');
        const card = document.getElementById('loginSuccessCard');
        if (!overlay) {
            window.location.href = redirectUrl;
            return;
        }

        overlay.classList.remove('hidden');
        requestAnimationFrame(() => {
            if (card) {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }
        });

        setTimeout(() => {
            window.location.href = redirectUrl;
        }, delay);
    }
</script>
