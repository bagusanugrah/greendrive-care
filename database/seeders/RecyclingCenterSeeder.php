<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecyclingCenter;

class RecyclingCenterSeeder extends Seeder
{
    public function run(): void
    {
        $centers = [
            [
                'name' => 'Bank Sampah Bersinar (Pusat Daur Ulang Aki)',
                'address' => 'Jl. Pahlawan No. X, Bandung',
                'latitude' => -6.899554, 
                'longitude' => 107.633512, // Area sekitar TMP Pahlawan
            ],
            [
                'name' => 'Pengepul Limbah Elektronik & Lampu LED',
                'address' => 'Jl. PHH Mustofa (Suci), Bandung',
                'latitude' => -6.897334,
                'longitude' => 107.636605, // Area sekitar Kampus Itenas
            ],
            [
                'name' => 'Gudang Daur Ulang Oli Bekas Sukaluyu',
                'address' => 'Kawasan Sukaluyu, Bandung',
                'latitude' => -6.891230,
                'longitude' => 107.625680,
            ]
        ];

        foreach ($centers as $center) {
            RecyclingCenter::create($center);
        }
    }
}