<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Catat Servis: {{ $vehicle->brand }} {{ $vehicle->model }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-2xl mx-auto">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('maintenance.store') }}" method="POST">
                        @csrf
                        
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div class="mb-4">
                            <label for="sparepart_id" class="block text-sm font-medium text-gray-700">Komponen yang Diganti</label>
                            <select name="sparepart_id" id="sparepart_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="" disabled selected>-- Pilih Komponen --</option>
                                @foreach($spareparts as $part)
                                    <option value="{{ $part->id }}">{{ $part->name }} (Masa pakai: {{ $part->estimated_lifespan_days }} hari)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="installed_date" class="block text-sm font-medium text-gray-700">Tanggal Pemasangan</label>
                            <input type="date" name="installed_date" id="installed_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" max="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                                Simpan Riwayat
                            </button>
                            <a href="{{ route('vehicles.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>