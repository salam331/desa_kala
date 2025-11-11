<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak-pengaduan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'kategori' => 'required|string',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Pengaduan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pengaduan Anda telah berhasil dikirim. Kami akan segera memprosesnya.');
    }

    public function adminIndex()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pengaduan', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
            'tanggapan' => 'nullable|string',
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'tanggal_tanggapan' => $request->tanggapan ? now() : null,
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
