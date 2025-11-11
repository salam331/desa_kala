<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use Illuminate\Http\Request;

class PotensiController extends Controller
{
    public function index()
    {
        // Ambil data potensi dari database
        $query = Potensi::active();

        // Filter berdasarkan kategori jika ada
        if (request('kategori')) {
            $query->kategori(request('kategori'));
        }

        $potensi = $query->get();

        // Kategori yang tersedia
        $kategoriList = ['semua', 'pertanian', 'peternakan', 'umkm', 'wisata', 'sumber_daya_alam'];

        return view('potensi-desa', compact('potensi', 'kategoriList'));
    }
}
