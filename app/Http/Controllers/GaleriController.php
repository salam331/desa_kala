<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kategori dari query parameter
        $kategori = $request->get('kategori', 'semua');

        // Ambil parent galerii beserta anaknya (child images)
        $query = Galeri::parents()->with('children')->active()->latestDate();
        if ($kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }

        $parents = $query->get();

        $galeri = [];
        foreach ($parents as $parent) {
            $group = [
                'id' => $parent->id,
                'judul' => $parent->judul,
                'deskripsi' => $parent->deskripsi,
                'kategori' => $parent->kategori,
                'foto' => [],
            ];

            foreach ($parent->children as $child) {
                // skip child without gambar
                if (!$child->gambar) continue;
                $group['foto'][] = [
                    'id' => $child->id,
                    'judul' => $child->judul,
                    'url' => asset($child->gambar),
                    'tanggal' => $child->tanggal?->format('Y-m-d'),
                    'deskripsi' => $child->deskripsi,
                    'deskfoto' => $child->deskfoto,
                ];
            }

            if (count($group['foto']) > 0) {
                $galeri[] = $group;
            }
        }

        // Kategori yang tersedia
        $kategoriList = ['semua', 'kegiatan', 'pembangunan', 'event', 'panorama'];

        return view('galeri-desa', compact('galeri', 'kategoriList', 'kategori'));
    }

    public function show($id)
    {
        // Show a parent gallery and its children images
        $parent = Galeri::where('is_parent', true)->with('children')->findOrFail($id);

        $images = $parent->children->map(function($child) {
            return [
                'id' => $child->id,
                'url' => asset($child->gambar),
                'deskripsi' => $child->deskripsi,
                'deskfoto' => $child->deskfoto,
                'judul' => $child->judul,
                'tanggal' => $child->tanggal?->format('Y-m-d'),
            ];
        });

        return view('galeri-show', compact('parent', 'images'));
    }
}
