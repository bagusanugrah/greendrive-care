<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
            Panel Admin: <span class="text-green-600">Master Data Suku Cadang</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Tambah Suku Cadang</h3>
                    
                    <form action="{{ route('admin.spareparts.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nama Komponen</label>
                            <input type="text" name="name" class="w-full rounded-xl border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500" placeholder="Misal: Busi CPR9EA-9" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label>
                            <select name="category" class="w-full rounded-xl border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500" required>
                                <option value="Kelistrikan">Kelistrikan</option>
                                <option value="Pelumas">Pelumas</option>
                                <option value="Mesin">Mesin</option>
                                <option value="Pengereman">Pengereman</option>
                                <option value="Kaki-kaki">Kaki-kaki</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Estimasi Umur (Hari)</label>
                            <input type="number" name="estimated_lifespan_days" class="w-full rounded-xl border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500" placeholder="Misal: 365" required>
                        </div>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-xl transition">
                            Simpan Komponen
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-2">
                @if(session('success'))
                    <div class="mb-4 bg-green-50 text-green-700 p-4 rounded-xl border border-green-200 font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-sm">
                                <th class="p-4 border-b">Nama Komponen</th>
                                <th class="p-4 border-b">Kategori</th>
                                <th class="p-4 border-b">Masa Pakai</th>
                                <th class="p-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @foreach($spareparts as $part)
                            <tr class="hover:bg-gray-50 border-b border-gray-50">
                                <td class="p-4 font-bold text-gray-900">{{ $part->name }}</td>
                                <td class="p-4 text-gray-600">{{ $part->category }}</td>
                                <td class="p-4 text-gray-600">{{ $part->estimated_lifespan_days }} hari</td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.spareparts.destroy', $part->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>