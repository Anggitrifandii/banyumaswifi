<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-[#1a44a6]">Form Pemasangan Baru</h2>
        <p class="text-sm text-slate-500 mt-1">Lengkapi data diri Anda untuk berlangganan BanyumasWiFi.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap Sesuai KTP" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="no_hp" value="Nomor WhatsApp Aktif" />
            <x-text-input id="no_hp" class="block mt-1 w-full" type="number" name="no_hp" :value="old('no_hp')" required />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="alamat" value="Alamat Pemasangan Lengkap" />
            <textarea id="alamat" name="alamat" rows="3" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm shadow-slate-200/50 block mt-1 w-full" required placeholder="Contoh: Jl. Merdeka No.10, RT 01/RW 02">{{ old('alamat') }}</textarea>
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="paket_id" value="Pilihan Paket Internet" />
            <select id="paket_id" name="paket_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm shadow-slate-200/50 block mt-1 w-full bg-blue-50 font-semibold" required>
                <option value="">-- Pilih Paket Internet --</option>
                @foreach($pakets as $paket)
                    <option value="{{ $paket->id }}" {{ (old('paket_id') == $paket->id || (isset($selectedPaket) && $selectedPaket == $paket->id)) ? 'selected' : '' }}>
                        {{ $paket->nama_paket }} ({{ $paket->kecepatan }}) - Rp {{ number_format($paket->harga, 0, ',', '.') }}/bln
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('paket_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="tanggal_pasang" value="Rencana Tanggal Pemasangan" />
            <x-text-input id="tanggal_pasang" class="block mt-1 w-full text-gray-700 cursor-pointer" type="date" name="tanggal_pasang" :value="old('tanggal_pasang', date('Y-m-d'))" min="{{ date('Y-m-d') }}" required />
            <p class="text-[10px] text-slate-500 mt-1">*Pilih jadwal kapan Anda ingin teknisi kami datang ke lokasi.</p>
            <x-input-error :messages="$errors->get('tanggal_pasang')" class="mt-2" />
        </div>

        <div class="my-6 border-t border-slate-200"></div>

        <div>
            <x-input-label for="email" value="Email (Untuk Login)" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Password Akun" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Ulangi Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="underline text-sm text-slate-600 hover:text-blue-600 rounded-md" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                Daftar & Ajukan Pasang
            </button>
        </div>
    </form>
</x-guest-layout>
