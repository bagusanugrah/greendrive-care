<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GreenDrive-Care') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-white">
        
        <div class="min-h-screen flex">
            <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-green-600 to-emerald-900 justify-center items-center p-12 text-white shadow-inner">
                <div class="max-w-lg">
                    <svg class="w-24 h-24 text-white mb-6 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h1 class="text-4xl font-extrabold mb-4 tracking-tight">GreenDrive-Care</h1>
                    <p class="text-lg text-green-100 leading-relaxed">
                        Bergabunglah bersama kami. Pantau masa pakai komponen motormu, cegah kerusakan sistemis, dan jadilah bagian dari siklus daur ulang otomotif yang berkelanjutan.
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 relative">
                
                <a href="{{ url('/') }}" class="absolute top-8 right-8 text-gray-400 hover:text-green-600 transition flex items-center gap-1 text-sm font-medium">
                    &larr; Kembali ke Beranda
                </a>

                <div class="w-full max-w-md">
                    <div class="lg:hidden flex justify-center mb-8">
                        <h1 class="text-3xl font-extrabold text-green-600">GreenDrive-Care</h1>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>

    </body>
</html>