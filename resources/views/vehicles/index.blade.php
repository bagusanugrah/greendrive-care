<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                <span class="text-green-600">Garasi</span> Saya 🏍️
            </h2>
            <a href="{{ route('vehicles.create') }}" class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white font-bold py-2.5 px-6 rounded-full shadow-lg transition-transform transform hover:-translate-y-1">
                + Tambah Kendaraan
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg shadow-sm" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($vehicles as $vehicle)
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-extrabold text-gray-900 group-hover:text-green-600 transition-colors">{{ $vehicle->brand }}</h3>
                                <p class="text-lg font-medium text-gray-500">{{ $vehicle->model }}</p>
                            </div>
                            <div class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">
                                {{ $vehicle->year }}
                            </div>
                        </div>
                        
                        <div class="w-full h-px bg-gray-200 mb-4"></div>

                        <div class="flex flex-col sm:flex-row gap-3 mt-5">
                            <a href="{{ route('vehicles.show', $vehicle->id) }}" class="flex-1 text-center bg-green-50 hover:bg-green-100 text-green-700 font-semibold py-2 px-4 rounded-xl border border-green-200 transition-colors">
                                📊 Lihat Status
                            </a>
                            <a href="{{ route('maintenance.create', ['vehicle_id' => $vehicle->id]) }}" class="flex-1 text-center bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-xl shadow-md transition-colors">
                                🔧 Catat Servis
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                        <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <h3 class="text-lg font-bold text-gray-900">Garasi Masih Kosong</h3>
                        <p class="text-gray-500 mt-1">Mulai dengan menambahkan data motor pertama Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>