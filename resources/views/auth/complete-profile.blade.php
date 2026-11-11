<x-guest-layout>
    <div class="fixed inset-0 bg-[#1e1e1e] flex items-center justify-center p-4 z-50">
        <div class="relative w-full max-w-[360px] bg-white rounded-[28px] px-7 py-8 shadow-2xl">
            {{-- Close Button (X) --}}
            <a href="{{ route('homepage') }}" class="absolute top-5 right-5 text-gray-900 hover:text-gray-600 transition-colors" aria-label="Tutup">
                <svg class="w-5 h-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

            {{-- Avatar Icon with Edit Badge --}}
            <div class="relative w-20 h-20 mx-auto mt-1 mb-4 flex items-center justify-center">
                @if(auth()->check() && auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}" class="w-20 h-20 rounded-full object-cover ring-2 ring-gray-100 shadow-inner">
                @else
                    {{-- Default Avatar Circle --}}
                    <svg class="w-20 h-20 text-[#555555]" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zm0 3c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" clip-rule="evenodd"/>
                    </svg>
                @endif 
            </div>

            {{-- Heading & Description --}}
            <h1 class="text-lg font-bold text-gray-900 text-center mb-1.5">Lengkapi Data Anda</h1>
            <p class="text-[11px] text-gray-500 text-center mb-6 max-w-[270px] mx-auto leading-relaxed">
                Nomor handphone dan alamat belum tersedia dari akun Google Anda. Mohon lengkapi terlebih dahulu sebelum melanjutkan.
            </p>

            {{-- Form --}}
            <form method="POST" action="{{ route('complete.profile.store') }}" class="space-y-4">
                @csrf

                {{-- Nomor Handphone --}}
                <div>
                    <label for="phone_number" class="block text-xs font-normal text-gray-600 mb-1.5">Nomor Handphone</label>
                    <input id="phone_number"
                        type="tel"
                        name="phone_number"
                        value="{{ old('phone_number', auth()->user()?->phone_number) }}"
                        required
                        placeholder="08xxxxxxxxx"
                        pattern="[0-9]{10,13}"
                        inputmode="numeric"
                        maxlength="13"
                        class="block w-full h-10 px-3.5 text-xs bg-white text-gray-800 border border-gray-300 rounded-lg focus:border-[#0d47a1] focus:ring-1 focus:ring-[#0d47a1] focus:outline-none placeholder-gray-400 transition-colors">
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-1" />
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="address" class="block text-xs font-normal text-gray-600 mb-1.5">Alamat</label>
                    <input id="address"
                        type="text"
                        name="address"
                        value="{{ old('address', auth()->user()?->address) }}"
                        required
                        placeholder="Jl. Merdeka No. 1, RT/RW, Kelurahan, Kecamatan, Kota"
                        class="block w-full h-10 px-3.5 text-xs bg-white text-gray-800 border border-gray-300 rounded-lg focus:border-[#0d47a1] focus:ring-1 focus:ring-[#0d47a1] focus:outline-none placeholder-gray-400 transition-colors">
                    <x-input-error :messages="$errors->get('address')" class="mt-1" />
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit"
                        class="w-full h-10 bg-[#0d47a1] hover:bg-[#0a3880] text-white font-medium text-xs rounded-lg shadow-sm transition-colors flex items-center justify-center">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Success Login Overlay --}}
    <x-login-success-overlay />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route('complete.profile.store') }}"]');
            if (!form) return;

            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Menyimpan...';

                try {
                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        triggerLoginSuccess(data.redirect_url || "{{ route('homepage') }}", 2500);
                    } else {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        if (data.errors) {
                            alert(Object.values(data.errors).flat().join('\n'));
                        } else {
                            alert(data.message || 'Terjadi kesalahan, silakan coba lagi.');
                        }
                    }
                } catch (err) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                    form.submit();
                }
            });
        });
    </script>
</x-guest-layout>
