<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Selamat Datang Kembali! 👋</h2>
        <p class="text-gray-500 mt-2">Silakan masukkan email dan password untuk mengakses garasi Anda.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="{{ __('Email') }}" class="font-bold text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm py-3 px-4" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex justify-between items-center">
                <x-input-label for="password" value="{{ __('Password') }}" class="font-bold text-gray-700" />
                @if (Route::has('password.request'))
                    <!-- <a class="text-sm text-green-600 hover:text-green-800 font-medium" href="{{ route('password.request') }}">
                        Lupa password?
                    </a> -->
                @endif
            </div>
            
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm py-3 px-4"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Masuk Sekarang
            </button>
        </div>
        
        <p class="text-center text-sm text-gray-600 mt-6">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-green-600 hover:text-green-800">Daftar di sini</a>
        </p>
    </form>
</x-guest-layout>