<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecyclingCenter;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    // Menampilkan halaman peta kosong pertama kali
    public function index()
    {
        return view('map.index');
    }

    // Mencari lokasi terdekat via AJAX Fetch
    public function findNearest(Request $request)
    {
        $userLat = $request->latitude;
        $userLng = $request->longitude;

        // Query Haversine langsung di MySQL
        $nearestCenters = RecyclingCenter::select(
            'id', 'name', 'address', 'latitude', 'longitude',
            DB::raw("(6371 * acos(cos(radians($userLat)) 
            * cos(radians(latitude)) 
            * cos(radians(longitude) - radians($userLng)) 
            + sin(radians($userLat)) 
            * sin(radians(latitude)))) AS distance")
        )
        ->having('distance', '<', 15) // Batasi radius maksimal 15 Kilometer
        ->orderBy('distance')
        ->limit(5) // Ambil 5 terdekat
        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $nearestCenters
        ]);
    }
}