<x-guest-layout>
    <div class="flex justify-center mb-6">
        <div class="w-16 h-16 rounded-full bg-white shadow flex items-center justify-center -mt-16 border-4 border-white mb-2">
            <svg class="w-8 h-8 text-[#0d6efd]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
        </div>
    </div>
    
    <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">Login</h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="flex items-center text-sm font-semibold text-slate-700 mb-1.5">
                <svg class="w-4 h-4 mr-1.5 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                Username
            </label>
            <input id="email" class="block w-full px-4 py-2 text-sm border border-slate-300 rounded focus:ring-[#0d6efd] focus:border-[#0d6efd] outline-none transition" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="flex items-center text-sm font-semibold text-slate-700 mb-1.5">
                <svg class="w-4 h-4 mr-1.5 text-slate-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                Password
            </label>
            <input id="password" class="block w-full px-4 py-2 text-sm border border-slate-300 rounded focus:ring-[#0d6efd] focus:border-[#0d6efd] outline-none transition" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot PW -->
        <div class="flex items-center justify-between text-xs mt-3">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#0d6efd] shadow-sm focus:ring-[#0d6efd]" name="remember">
                <span class="ms-2 font-medium text-slate-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="font-medium text-[#0d6efd] hover:underline transition" href="{{ route('password.request') }}">
                    Lupa Password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-[#0d6efd] hover:bg-blue-700 text-white font-bold py-2.5 rounded transition duration-200 mt-4">
            Login
        </button>
    </form>
</x-guest-layout>
