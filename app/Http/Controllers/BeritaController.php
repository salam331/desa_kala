<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        // Filter berdasarkan kategori jika ada
        $kategori = $request->get('kategori');
        if ($kategori && $kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        $berita = $query->orderBy('tanggal', 'desc')->paginate(10);

        // Kategori yang tersedia
        $kategoriList = ['semua', 'Berita Desa', 'Kegiatan', 'Pengumuman', 'Informasi', 'Berita Lainnya'];

        return view('berita.index', compact('berita', 'kategori', 'kategoriList'));
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        // Fetch related berita (same category, excluding current)
        $relatedBerita = Berita::where('kategori', $berita->kategori)
            ->where('id', '!=', $id)
            ->orderBy('tanggal', 'desc')
            ->limit(3)
            ->get();

        return view('berita.show', compact('berita', 'relatedBerita'));
    }
}
