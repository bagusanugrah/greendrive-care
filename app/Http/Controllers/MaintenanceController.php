<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceLog;
use App\Models\Vehicle;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    // Menampilkan form tambah servis
    public function create(Request $request)
    {
        // Ambil data kendaraan berdasarkan ID yang dikirim dari tombol
        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        // Keamanan: Pastikan kendaraan ini benar-benar milik user yang sedang login
        if ($vehicle->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        // Ambil semua daftar suku cadang dari database
        $spareparts = Sparepart::all();

        return view('maintenance.create', compact('vehicle', 'spareparts'));
    }

    // Menyimpan data servis ke database
    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'sparepart_id' => 'required|exists:spareparts,id',
            'installed_date' => 'required|date|before_or_equal:today',
        ]);

        // Keamanan tambahan
        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        if ($vehicle->user_id !== Auth::id()) {
            abort(403);
        }

        MaintenanceLog::create([
            'vehicle_id' => $request->vehicle_id,
            'sparepart_id' => $request->sparepart_id,
            'installed_date' => $request->installed_date,
            'status' => 'active'
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Riwayat servis berhasil dicatat!');
    }
}
