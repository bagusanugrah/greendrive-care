<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    // Menampilkan halaman daftar dan form tambah
    public function index()
    {
        $spareparts = Sparepart::latest()->get();
        return view('admin.spareparts.index', compact('spareparts'));
    }

    // Menyimpan data ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'estimated_lifespan_days' => 'required|integer|min:1',
        ]);

        Sparepart::create($request->all());

        return redirect()->route('admin.spareparts.index')->with('success', 'Suku cadang baru berhasil ditambahkan!');
    }

    // Menghapus data
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('admin.spareparts.index')->with('success', 'Suku cadang berhasil dihapus!');
    }
}