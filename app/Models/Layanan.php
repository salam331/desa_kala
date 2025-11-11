<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'prosedur',
        'syarat',
        'waktu_proses',
        'biaya',
        'kontak',
        'gambar',
        'is_active',
    ];

    protected $casts = [
        'prosedur' => 'array',
        'syarat' => 'array',
        'is_active' => 'boolean',
    ];

    // Scope untuk layanan aktif
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
