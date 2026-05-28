<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sparepart;

class SparepartSeeder extends Seeder
{
    public function run(): void
    {
        $parts = [
            [
                'name' => 'Aki GTZ6V (12V 5Ah)',
                'category' => 'Kelistrikan',
                'estimated_lifespan_days' => 540, // Sekitar 1,5 tahun
            ],
            [
                'name' => 'Aki GTZ7S (12V 6Ah)',
                'category' => 'Kelistrikan',
                'estimated_lifespan_days' => 730, // Sekitar 2 tahun
            ],
            [
                'name' => 'Lampu Sein LED',
                'category' => 'Kelistrikan',
                'estimated_lifespan_days' => 1095, // Sekitar 3 tahun
            ],
            [
                'name' => 'Oli Mesin 10W-40',
                'category' => 'Pelumas',
                'estimated_lifespan_days' => 60, // Per 2 bulan
            ]
        ];

        foreach ($parts as $part) {
            Sparepart::create($part);
        }
    }
}