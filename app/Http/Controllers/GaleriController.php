<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari query parameter
        $kategoriFilter = $request->get('kategori', 'semua');

        // Query galeri berdasarkan kategori dan aktif
        $query = Galeri::active()->latestDate();

        if ($kategoriFilter !== 'semua') {
            $query->where('kategori', $kategoriFilter);
        }

        $galeriItems = $query->get();

        // Kelompokkan berdasarkan album
        $galeri = [];
        $albumDescriptions = [
            'kegiatan' => 'Dokumentasi berbagai kegiatan yang dilaksanakan di Desa Kala',
            'pembangunan' => 'Dokumentasi pembangunan infrastruktur desa',
            'event' => 'Dokumentasi event dan festival yang diadakan di desa',
            'panorama' => 'Keindahan panorama dan pemandangan Desa Kala'
        ];

        $albumNames = [
            'kegiatan' => 'Kegiatan Desa',
            'pembangunan' => 'Pembangunan Infrastruktur',
            'event' => 'Event dan Festival',
            'panorama' => 'Panorama Desa'
        ];

        foreach ($galeriItems as $item) {
            $albumKey = $item->album ?: $item->kategori;

            if (!isset($galeri[$albumKey])) {
                $galeri[$albumKey] = [
                    'album' => $albumNames[$item->kategori] ?? ucfirst($albumKey),
                    'kategori' => $item->kategori,
                    'deskripsi' => $albumDescriptions[$item->kategori] ?? 'Koleksi foto ' . ucfirst($albumKey),
                    'foto' => []
                ];
            }

            $galeri[$albumKey]['foto'][] = [
                'id' => $item->id,
                'judul' => $item->judul,
                'url' => asset($item->gambar),
                'tanggal' => $item->tanggal->format('Y-m-d'),
                'deskripsi' => $item->deskripsi
            ];
        }

        // Jika tidak ada data, tetap tampilkan struktur kosong untuk kategori yang ada
        if (empty($galeri) && $kategoriFilter === 'semua') {
            foreach ($albumNames as $key => $name) {
                $galeri[$key] = [
                    'album' => $name,
                    'kategori' => $key,
                    'deskripsi' => $albumDescriptions[$key],
                    'foto' => []
                ];
            }
        }

        // Kategori yang tersedia
        $kategoriList = ['semua', 'kegiatan', 'pembangunan', 'event', 'panorama'];

        return view('galeri-desa', compact('galeri', 'kategoriList'));
    }
}
