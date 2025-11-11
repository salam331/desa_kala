<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        // Ambil data layanan dari database
        $query = Layanan::active();

        // Filter berdasarkan kategori jika ada
        if (request('kategori')) {
            $query->kategori(request('kategori'));
        }

        $layanan = $query->get();

        // Kategori yang tersedia
        $kategoriList = ['semua', 'administrasi', 'perizinan'];

        return view('layanan-publik', compact('layanan', 'kategoriList'));
    }
}
