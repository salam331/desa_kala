<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potensi extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'detail',
        'gambar',
        'kontak',
        'telepon',
        'lokasi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk potensi aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        if ($kategori && $kategori !== 'semua') {
            return $query->where('kategori', $kategori);
        }
        return $query;
    }
}
