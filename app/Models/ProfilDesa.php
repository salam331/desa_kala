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

    public function getPetaEmbedDisplayAttribute()
    {
        if (!$this->peta_embed) return null;

        if (str_contains($this->peta_embed, '<iframe')) {
            return $this->peta_embed;
        }

        // Check if it's a Google Maps URL with coordinates
        if (preg_match('/google\.com\/maps.*@(-?\d+\.\d+),(-?\d+\.\d+)/', $this->peta_embed, $matches)) {
            $lat = $matches[1];
            $lng = $matches[2];
            $embedUrl = "https://maps.google.com/maps?q={$lat},{$lng}&output=embed";
            return '<iframe src="' . $embedUrl . '" width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        }

        // Assume it's an embed URL and wrap in iframe
        return '<iframe src="' . $this->peta_embed . '" width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
    }
}
