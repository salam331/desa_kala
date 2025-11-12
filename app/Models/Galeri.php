<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'kategori',
        'album',
        'tanggal',
        'is_active'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean'
    ];

    // Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Scope untuk filter album
    public function scopeAlbum($query, $album)
    {
        return $query->where('album', $album);
    }

    // Scope untuk filter aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk order by tanggal terbaru
    public function scopeLatestDate($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}
