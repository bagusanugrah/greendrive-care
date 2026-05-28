<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GreenDrive-Care</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="max-w-4xl mx-auto p-6 sm:p-8 text-center">
            
            <div class="flex justify-center mb-6">
                <svg class="w-20 h-20 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
                GreenDrive-<span class="text-green-600">Care</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                Platform manajemen cerdas untuk memperpanjang usia suku cadang kendaraan Anda dan memetakan lokasi daur ulang limbah otomotif. Berkendara aman, lingkungan nyaman.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ route('vehicles.index') }}" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-md transition duration-300">
                        Masuk ke Garasi Saya &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow-md transition duration-300">
                        Masuk (Login)
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-lg shadow-sm border border-gray-300 transition duration-300">
                        Daftar Akun Baru
                    </a>
                @endauth
            </div>
            
            <div class="mt-12 text-sm text-gray-500 font-medium">
                Mendukung Sustainable Development Goals (SDG 12) - Konsumsi & Produksi yang Bertanggung Jawab
            </div>

        </div>
    </div>

</body>
</html>