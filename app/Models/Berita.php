<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'tanggal',
        'ringkasan',
        'konten',
        'gambar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
