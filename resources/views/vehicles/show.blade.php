<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Status Komponen: {{ $vehicle->brand }} {{ $vehicle->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4">
                <a href="{{ route('vehicles.index') }}" class="text-gray-600 hover:text-gray-900">&larr; Kembali ke Garasi</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Komponen Aktif Terpasang</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse ($activeLogs as $log)
                            @php
                                if ($log->days_left > 14) {
                                    $bgColor = 'bg-green-100 border-green-400';
                                    $textColor = 'text-green-800';
                                    $statusText = 'Aman';
                                } elseif ($log->days_left >= 0 && $log->days_left <= 14) {
                                    $bgColor = 'bg-yellow-100 border-yellow-400';
                                    $textColor = 'text-yellow-800';
                                    $statusText = 'Peringatan (Siapkan Pengganti)';
                                } else {
                                    $bgColor = 'bg-red-100 border-red-400';
                                    $textColor = 'text-red-800';
                                    $statusText = 'Kritis (Segera Ganti & Daur Ulang)';
                                }
                            @endphp

                            <div class="border-l-4 {{ $bgColor }} p-4 rounded shadow-sm">
                                <h4 class="font-bold text-md">{{ $log->sparepart->name }}</h4>
                                <p class="text-sm text-gray-600 mb-2">Dipasang: {{ \Carbon\Carbon::parse($log->installed_date)->format('d M Y') }}</p>
                                
                                <div class="mt-2 {{ $textColor }} font-semibold text-sm">
                                    Status: {{ $statusText }}
                                </div>
                                <div class="{{ $textColor }} font-bold text-lg">
                                    @if($log->days_left < 0)
                                        Terlewat {{ abs($log->days_left) }} hari!
                                    @else
                                        Sisa: {{ $log->days_left }} hari
                                    @endif
                                </div>
                                
                                @if($log->days_left <= 14)
                                    <div class="mt-3">
                                        <a href="{{ route('map.index') }}" class="text-xs bg-red-600 hover:bg-red-700 text-white py-1 px-2 rounded">
                                            Cari Tempat Daur Ulang
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500">Belum ada komponen yang dicatat untuk kendaraan ini.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>