<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
            Tambah <span class="text-green-600">Kendaraan Baru</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-green-600 p-6 text-white">
                    <h3 class="text-xl font-bold">Data Kendaraan</h3>
                    <p class="text-green-100 text-sm mt-1">Masukkan spesifikasi kendaraan untuk mulai melacak suku cadang.</p>
                </div>

                <div class="p-8 text-gray-900">
                    <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="brand" class="block text-sm font-bold text-gray-700 mb-2">Merek (Contoh: Honda)</label>
                            <input type="text" name="brand" id="brand" class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 shadow-sm focus:border-green-500 focus:bg-white focus:ring-green-500 transition-colors" required>
                        </div>

                        <div>
                            <label for="model" class="block text-sm font-bold text-gray-700 mb-2">Model (Contoh: CB150R)</label>
                            <input type="text" name="model" id="model" class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 shadow-sm focus:border-green-500 focus:bg-white focus:ring-green-500 transition-colors" required>
                        </div>

                        <div>
                            <label for="year" class="block text-sm font-bold text-gray-700 mb-2">Tahun Perakitan</label>
                            <input type="number" name="year" id="year" class="block w-full rounded-xl border-gray-300 bg-gray-50 p-3 text-gray-900 shadow-sm focus:border-green-500 focus:bg-white focus:ring-green-500 transition-colors" required>
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-100">
                            <a href="{{ route('vehicles.index') }}" class="text-gray-500 hover:text-gray-800 font-medium transition-colors">Batal</a>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition-transform transform hover:-translate-y-0.5">
                                Simpan Kendaraan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>