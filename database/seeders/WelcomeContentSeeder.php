<?php

namespace Database\Seeders;

use App\Models\WelcomeContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WelcomeContent::create([
            'village_name' => 'Desa Kala',
            'hero_title' => 'Selamat Datang di Desa Kala',
            'hero_description' => 'Pusat informasi, kegiatan, dan potensi Desa Kala yang asri dan penuh budaya.',
            'hero_button_text' => 'Jelajahi Sekarang',
            'hero_button_link' => '#profil',
            'hero_background_image' => 'https://images.unsplash.com/photo-1527030280862-64139fba04ca?auto=format&fit=crop&w=1920&q=80',
            'profile_title' => 'Profil Desa',
            'profile_description' => 'Mengenal lebih dekat Desa Kala, pesona alam dan masyarakatnya.',
            'location_title' => 'Letak Geografis',
            'location_description' => 'Desa Kala terletak di lereng pegunungan dengan udara sejuk dan panorama alam yang menakjubkan.',
            'agriculture_title' => 'Potensi Pertanian',
            'agriculture_description' => 'Pertanian menjadi sektor utama dengan hasil bumi unggulan seperti sayuran segar dan buah tropis.',
            'culture_title' => 'Budaya & Tradisi',
            'culture_description' => 'Tradisi gotong royong dan kearifan lokal tetap terjaga, menciptakan masyarakat yang harmonis.',
            'footer_text' => '© 2025 Desa Kala. Seluruh hak cipta dilindungi.',
        ]);
    }
}
