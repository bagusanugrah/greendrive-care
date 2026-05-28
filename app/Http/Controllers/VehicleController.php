<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VehicleController extends Controller
{
    public function index()
    {
        // Mengambil data kendaraan yang hanya milik user yang sedang login
        $vehicles = Auth::user()->vehicles;
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year'  => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        // Simpan data kendaraan dan otomatis kaitkan dengan user_id
        Auth::user()->vehicles()->create($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Cari kendaraan, pastikan milik user yang login
        $vehicle = Vehicle::findOrFail($id);
        if ($vehicle->user_id !== Auth::id()) {
            abort(403, 'Akses Ditolak');
        }

        // Ambil riwayat servis yang statusnya masih 'active'
        $activeLogs = $vehicle->maintenanceLogs()->with('sparepart')->where('status', 'active')->get();

        // LOGIKA RULE-BASED: Hitung sisa hari untuk setiap komponen
        foreach ($activeLogs as $log) {
            $installedDate = Carbon::parse($log->installed_date);
            $lifespanDays = $log->sparepart->estimated_lifespan_days;
            
            // Tanggal kedaluwarsa = Tanggal pasang + Umur ideal
            $deadlineDate = $installedDate->copy()->addDays($lifespanDays);
            
            // Hitung selisih hari dengan hari ini (false = bisa bernilai minus jika kelewat)
            $log->days_left = round(Carbon::now()->diffInDays($deadlineDate, false));
        }

        return view('vehicles.show', compact('vehicle', 'activeLogs'));
    }
}