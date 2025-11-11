<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use App\Models\StrukturPemerintahan;
use Illuminate\Http\Request;

class ProfilDesaController extends Controller
{
    public function index()
    {
        $profilDesa = ProfilDesa::first();
        $strukturPemerintahan = StrukturPemerintahan::active()->ordered()->get();

        return view('profil-desa', compact('profilDesa', 'strukturPemerintahan'));
    }
}
