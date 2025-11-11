<?php

namespace Database\Seeders;

use App\Models\WelcomeElement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WelcomeElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elements = [
            // Navbar
            [
                'element_type' => 'navbar',
                'element_key' => 'village_name',
                'content' => 'Desa Kala',
                'sort_order' => 1,
            ],
            [
                'element_type' => 'navbar',
                'element_key' => 'menu_beranda',
                'content' => 'Beranda',
                'sort_order' => 2,
            ],
            [
                'element_type' => 'navbar',
                'element_key' => 'menu_profil',
                'content' => 'Profil Desa',
                'sort_order' => 3,
            ],
            [
                'element_type' => 'navbar',
                'element_key' => 'menu_berita',
                'content' => 'Berita',
                'sort_order' => 4,
            ],
            [
                'element_type' => 'navbar',
                'element_key' => 'menu_kontak',
                'content' => 'Kontak',
                'sort_order' => 5,
            ],

            // Hero Section
            [
                'element_type' => 'hero',
                'element_key' => 'title',
                'content' => 'Selamat Datang di Desa Kala',
                'sort_order' => 1,
            ],
            [
                'element_type' => 'hero',
                'element_key' => 'description',
                'content' => 'Pusat informasi, kegiatan, dan potensi Desa Kala yang asri dan penuh budaya.',
                'sort_order' => 2,
            ],
            [
                'element_type' => 'hero',
                'element_key' => 'button_text',
                'content' => 'Jelajahi Sekarang',
                'sort_order' => 3,
            ],
            [
                'element_type' => 'hero',
                'element_key' => 'button_link',
                'content' => '#profil',
                'sort_order' => 4,
            ],
            [
                'element_type' => 'hero',
                'element_key' => 'background_image',
                'content' => 'https://images.unsplash.com/photo-1527030280862-64139fba04ca?auto=format&fit=crop&w=1920&q=80',
                'sort_order' => 5,
            ],

            // Profile Section
            [
                'element_type' => 'profile',
                'element_key' => 'title',
                'content' => 'Profil Desa',
                'sort_order' => 1,
            ],
            [
                'element_type' => 'profile',
                'element_key' => 'description',
                'content' => 'Mengenal lebih dekat Desa Kala, pesona alam dan masyarakatnya.',
                'sort_order' => 2,
            ],

            // Location Card
            [
                'element_type' => 'location',
                'element_key' => 'title',
                'content' => 'Letak Geografis',
                'sort_order' => 1,
            ],
            [
                'element_type' => 'location',
                'element_key' => 'description',
                'content' => 'Desa Kala terletak di lereng pegunungan dengan udara sejuk dan panorama alam yang menakjubkan.',
                'sort_order' => 2,
            ],

            // Agriculture Card
            [
                'element_type' => 'agriculture',
                'element_key' => 'title',
                'content' => 'Potensi Pertanian',
                'sort_order' => 1,
            ],
            [
                'element_type' => 'agriculture',
                'element_key' => 'description',
                'content' => 'Pertanian menjadi sektor utama dengan hasil bumi unggulan seperti sayuran segar dan buah tropis.',
                'sort_order' => 2,
            ],

            // Culture Card
            [
                'element_type' => 'culture',
                'element_key' => 'title',
                'content' => 'Budaya & Tradisi',
                'sort_order' => 1,
            ],
            [
                'element_type' => 'culture',
                'element_key' => 'description',
                'content' => 'Tradisi gotong royong dan kearifan lokal tetap terjaga, menciptakan masyarakat yang harmonis.',
                'sort_order' => 2,
            ],

            // Footer
            [
                'element_type' => 'footer',
                'element_key' => 'text',
                'content' => '© 2025 Desa Kala. Seluruh hak cipta dilindungi.',
                'sort_order' => 1,
            ],
        ];

        foreach ($elements as $element) {
            WelcomeElement::create($element);
        }
    }
}
