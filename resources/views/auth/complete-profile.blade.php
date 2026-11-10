<x-guest-layout>
    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-2xl">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('icons/logo_bandung_computer.png') }}" alt="Bandung Computer Logo" class="w-[180px] object-contain">
        </div>

        <h1 class="text-xl font-bold text-[#0F172A] text-center mb-1">Lengkapi Data Anda</h1>
        <p class="text-xs text-slate-500 text-center mb-6">
            Nomor handphone dan alamat belum tersedia dari akun Google Anda. Mohon lengkapi terlebih dahulu sebelum melanjutkan.
        </p>

        <form method="POST" action="{{ route('complete.profile.store') }}" class="space-y-4">
            @csrf

            {{-- Nomor Handphone --}}
            <div>
                <x-input-label for="phone_number" :value="__('Nomor Handphone')" class="text-sm font-medium text-[#0F172A] mb-1" />
                <input id="phone_number"
                    type="tel"
                    name="phone_number"
                    value="{{ old('phone_number', auth()->user()->phone_number) }}"
                    required
                    placeholder="08xxxxxxxxx"
                    pattern="[0-9]{10,13}"
                    inputmode="numeric"
                    maxlength="13"
                    class="block w-full h-11 px-4 text-sm bg-white text-gray-800 border border-gray-200 rounded-xl focus:border-gray-300 focus:ring-0 focus:outline-none placeholder-gray-400 transition-colors">
                <x-input-error :messages="$errors->get('phone_number')" class="mt-1" />
            </div>

            {{-- Alamat --}}
            <div>
                <x-input-label for="address" :value="__('Alamat')" class="text-sm font-medium text-[#0F172A] mb-1" />
                <textarea id="address"
                    name="address"
                    rows="3"
                    required
                    placeholder="Jl. Merdeka No. 1, RT/RW, Kelurahan, Kecamatan, Kota"
                    class="block w-full px-4 py-2 text-sm bg-white text-gray-800 border border-gray-200 rounded-xl focus:border-gray-300 focus:ring-0 focus:outline-none placeholder-gray-400 transition-colors resize-none">{{ old('address', auth()->user()->address) }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-1" />
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="w-full h-11 bg-[#0D47A1] hover:bg-[#F8FAFC] text-[#F8FAFC] hover:text-[#0D47A1] hover:ring-1 hover:ring-[#0D47A1] focus:outline-none font-semibold text-sm rounded-xl shadow-md transition-all flex items-center justify-center">
                    Simpan &amp; Lanjut
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
