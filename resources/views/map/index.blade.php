<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peta Daur Ulang Terdekat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="mb-4 flex items-center justify-between">
                        <p class="text-gray-600">Tekan tombol di bawah untuk mendeteksi lokasi Anda dan mencari pengepul terdekat.</p>
                        <button id="btn-find" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow">
                            📍 Deteksi Lokasi Saya
                        </button>
                    </div>

                    <div id="map" class="w-full h-96 rounded border bg-gray-100 z-0 relative"></div>

                    <div class="mt-6">
                        <h3 class="font-bold text-lg mb-2">Daftar Tempat Terdekat:</h3>
                        <ul id="result-list" class="space-y-2">
                            <li class="text-gray-500 italic">Belum ada pencarian.</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Peta (Default di tengah kota Bandung)
            const map = L.map('map').setView([-6.914744, 107.609810], 12);
            
            // Tambahkan Tile Layer (Peta dari OpenStreetMap - Gratis)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let userMarker;
            let centerMarkers = [];

            document.getElementById('btn-find').addEventListener('click', function() {
                const btn = this;
                btn.innerHTML = 'Mencari...';
                btn.disabled = true;

                // Meminta Izin Lokasi GPS dari Browser User
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        // Tandai posisi User di Peta (Marker Biru)
                        if(userMarker) map.removeLayer(userMarker);
                        userMarker = L.marker([userLat, userLng]).addTo(map)
                            .bindPopup('<b>Lokasi Anda Saat Ini</b>').openPopup();
                        map.setView([userLat, userLng], 14);

                        // Kirim koordinat ke backend Laravel via Fetch API
                        fetch("{{ route('map.search') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ latitude: userLat, longitude: userLng })
                        })
                        .then(response => response.json())
                        .then(data => {
                            btn.innerHTML = '📍 Deteksi Ulang Lokasi';
                            btn.disabled = false;
                            
                            // Hapus marker lama
                            centerMarkers.forEach(marker => map.removeLayer(marker));
                            centerMarkers = [];
                            
                            const resultList = document.getElementById('result-list');
                            resultList.innerHTML = '';

                            if(data.data.length === 0) {
                                resultList.innerHTML = '<li class="text-red-500">Tidak ada tempat daur ulang dalam radius 15 KM.</li>';
                                return;
                            }

                            // Looping data dari database untuk ditampilkan
                            data.data.forEach(center => {
                                // Buat Marker di Peta (Marker Hijau/Default)
                                const marker = L.marker([center.latitude, center.longitude]).addTo(map)
                                    .bindPopup(`<b>${center.name}</b><br>Jarak: ${parseFloat(center.distance).toFixed(2)} KM`);
                                centerMarkers.push(marker);

                                // Tambahkan ke List HTML
                                const li = document.createElement('li');
                                li.className = 'border p-3 rounded shadow-sm bg-gray-50 flex justify-between items-center';
                                li.innerHTML = `
                                    <div>
                                        <div class="font-bold text-gray-800">${center.name}</div>
                                        <div class="text-sm text-gray-600">${center.address}</div>
                                    </div>
                                    <div class="text-green-700 font-bold bg-green-100 px-3 py-1 rounded">
                                        ${parseFloat(center.distance).toFixed(2)} KM
                                    </div>
                                `;
                                resultList.appendChild(li);
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat mengambil data.');
                            btn.innerHTML = '📍 Deteksi Lokasi Saya';
                            btn.disabled = false;
                        });

                    }, function () {
                        alert('Gagal mendapatkan lokasi. Pastikan izin GPS di browser aktif.');
                        btn.innerHTML = '📍 Deteksi Lokasi Saya';
                        btn.disabled = false;
                    });
                } else {
                    alert("Browser Anda tidak mendukung Geolocation.");
                }
            });
        });
    </script>
</x-app-layout>