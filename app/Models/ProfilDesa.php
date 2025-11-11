<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = [
        'sejarah_desa',
        'visi',
        'misi',
        'data_wilayah',
        'peta_embed',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'data_wilayah' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];
}
