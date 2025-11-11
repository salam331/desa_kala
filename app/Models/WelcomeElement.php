<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeElement extends Model
{
    protected $fillable = [
        'element_type',
        'element_key',
        'content',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope untuk element aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk element type tertentu
    public function scopeOfType($query, $type)
    {
        return $query->where('element_type', $type);
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // Helper method untuk mendapatkan content berdasarkan type dan key
    public static function getContent($type, $key, $default = '')
    {
        $element = static::ofType($type)->where('element_key', $key)->active()->first();
        return $element ? $element->content : $default;
    }

    // Helper method untuk mendapatkan semua elements dari suatu type
    public static function getElementsByType($type)
    {
        return static::ofType($type)->active()->ordered()->get();
    }

    // Method untuk mendapatkan label yang lebih mudah dipahami dari element_key
    public function getElementKeyLabel()
    {
        $labels = [
            // Navbar
            'village_name' => 'Nama Desa',

            // Hero
            'hero_title' => 'Judul Hero',
            'hero_description' => 'Deskripsi Hero',
            'hero_button_text' => 'Teks Tombol Hero',
            'hero_button_link' => 'Link Tombol Hero',
            'hero_background_image' => 'Gambar Latar Hero',

            // Profile
            'profile_title' => 'Judul Profil',
            'profile_description' => 'Deskripsi Profil',

            // Location
            'location_title' => 'Judul Lokasi',
            'location_description' => 'Deskripsi Lokasi',

            // Agriculture
            'agriculture_title' => 'Judul Pertanian',
            'agriculture_description' => 'Deskripsi Pertanian',

            // Culture
            'culture_title' => 'Judul Budaya',
            'culture_description' => 'Deskripsi Budaya',

            // Footer
            'footer_text' => 'Teks Footer',
            'footer_copyright' => 'Copyright Footer',
        ];

        return $labels[$this->element_key] ?? ucfirst(str_replace('_', ' ', $this->element_key));
    }
}
