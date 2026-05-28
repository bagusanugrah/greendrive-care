<x-guest-layout>
    
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Buat Akun Baru 🚀</h2>
        <p class="text-gray-500 mt-2">Mulai perjalanan berkendara yang lebih ramah lingkungan hari ini.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" value="Nama Lengkap" class="font-bold text-gray-700" />
            <x-text-input id="name" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm py-2 px-3" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Bagus Anugrah" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="{{ __('Email') }}" class="font-bold text-gray-700" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm py-2 px-3" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="contoh@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="{{ __('Password') }}" class="font-bold text-gray-700" />
            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm py-2 px-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" class="font-bold text-gray-700" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm py-2 px-3"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password di atas" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                Daftar Akun
            </button>
        </div>

        <p class="text-center text-sm text-gray-600 mt-6">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-bold text-green-600 hover:text-green-800">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>