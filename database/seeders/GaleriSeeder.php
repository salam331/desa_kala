<?php

namespace Database\Seeders;

use App\Models\Galeri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GaleriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galeriData = [
            // Kegiatan Desa
            [
                'judul' => 'Gotong Royong Bersih Desa',
                'deskripsi' => 'Kegiatan gotong royong membersihkan lingkungan desa yang diikuti oleh seluruh warga',
                'gambar' => 'https://via.placeholder.com/400x300?text=Gotong+Royong',
                'kategori' => 'kegiatan',
                'album' => 'Kegiatan Desa',
                'tanggal' => '2023-11-15',
                'is_active' => true,
            ],
            [
                'judul' => 'Pelatihan Wirausaha',
                'deskripsi' => 'Pelatihan keterampilan wirausaha bagi pemuda desa',
                'gambar' => 'https://via.placeholder.com/400x300?text=Pelatihan+Wirausaha',
                'kategori' => 'kegiatan',
                'album' => 'Kegiatan Desa',
                'tanggal' => '2023-11-10',
                'is_active' => true,
            ],
            [
                'judul' => 'Posyandu Balita',
                'deskripsi' => 'Kegiatan posyandu rutin untuk kesehatan balita dan ibu hamil',
                'gambar' => 'https://via.placeholder.com/400x300?text=Posyandu+Balita',
                'kategori' => 'kegiatan',
                'album' => 'Kegiatan Desa',
                'tanggal' => '2023-11-08',
                'is_active' => true,
            ],
            [
                'judul' => 'Kegiatan Karang Taruna',
                'deskripsi' => 'Kegiatan sosial Karang Taruna Desa Kala',
                'gambar' => 'https://via.placeholder.com/400x300?text=Karang+Taruna',
                'kategori' => 'kegiatan',
                'album' => 'Kegiatan Desa',
                'tanggal' => '2023-11-05',
                'is_active' => true,
            ],

            // Pembangunan Infrastruktur
            [
                'judul' => 'Pembangunan Jalan Desa',
                'deskripsi' => 'Proses pembangunan jalan paving di Dusun Kala Indah',
                'gambar' => 'https://via.placeholder.com/400x300?text=Pembangunan+Jalan',
                'kategori' => 'pembangunan',
                'album' => 'Pembangunan Infrastruktur',
                'tanggal' => '2023-10-20',
                'is_active' => true,
            ],
            [
                'judul' => 'Renovasi Balai Desa',
                'deskripsi' => 'Renovasi gedung balai desa dengan dana desa',
                'gambar' => 'https://via.placeholder.com/400x300?text=Renovasi+Balai',
                'kategori' => 'pembangunan',
                'album' => 'Pembangunan Infrastruktur',
                'tanggal' => '2023-10-15',
                'is_active' => true,
            ],
            [
                'judul' => 'Pembangunan Sumur Bor',
                'deskripsi' => 'Pembangunan sumur bor untuk sumber air bersih warga',
                'gambar' => 'https://via.placeholder.com/400x300?text=Sumur+Bor',
                'kategori' => 'pembangunan',
                'album' => 'Pembangunan Infrastruktur',
                'tanggal' => '2023-10-10',
                'is_active' => true,
            ],
            [
                'judul' => 'Pemasangan Listrik',
                'deskripsi' => 'Pemasangan jaringan listrik ke rumah-rumah warga',
                'gambar' => 'https://via.placeholder.com/400x300?text=Pemasangan+Listrik',
                'kategori' => 'pembangunan',
                'album' => 'Pembangunan Infrastruktur',
                'tanggal' => '2023-10-05',
                'is_active' => true,
            ],

            // Event dan Festival
            [
                'judul' => 'Festival Desa Kala',
                'deskripsi' => 'Festival budaya dan kuliner Desa Kala',
                'gambar' => 'https://via.placeholder.com/400x300?text=Festival+Desa',
                'kategori' => 'event',
                'album' => 'Event dan Festival',
                'tanggal' => '2023-09-25',
                'is_active' => true,
            ],
            [
                'judul' => 'Hari Kemerdekaan',
                'deskripsi' => 'Peringatan Hari Kemerdekaan RI di Desa Kala',
                'gambar' => 'https://via.placeholder.com/400x300?text=Hari+Kemerdekaan',
                'kategori' => 'event',
                'album' => 'Event dan Festival',
                'tanggal' => '2023-08-17',
                'is_active' => true,
            ],
            [
                'judul' => 'Pesta Panen',
                'deskripsi' => 'Pesta panen raya Desa Kala',
                'gambar' => 'https://via.placeholder.com/400x300?text=Pesta+Panen',
                'kategori' => 'event',
                'album' => 'Event dan Festival',
                'tanggal' => '2023-08-10',
                'is_active' => true,
            ],
            [
                'judul' => 'Festival Kesenian',
                'deskripsi' => 'Festival kesenian tradisional Desa Kala',
                'gambar' => 'https://via.placeholder.com/400x300?text=Festival+Kesenian',
                'kategori' => 'event',
                'album' => 'Event dan Festival',
                'tanggal' => '2023-07-20',
                'is_active' => true,
            ],

            // Panorama Desa
            [
                'judul' => 'Pemandangan Sawah',
                'deskripsi' => 'Pemandangan sawah hijau di pagi hari',
                'gambar' => 'https://via.placeholder.com/400x300?text=Pemandangan+Sawah',
                'kategori' => 'panorama',
                'album' => 'Panorama Desa',
                'tanggal' => '2023-11-01',
                'is_active' => true,
            ],
            [
                'judul' => 'Air Terjun Kala',
                'deskripsi' => 'Keindahan Air Terjun Kala dari kejauhan',
                'gambar' => 'https://via.placeholder.com/400x300?text=Air+Terjun',
                'kategori' => 'panorama',
                'album' => 'Panorama Desa',
                'tanggal' => '2023-10-28',
                'is_active' => true,
            ],
            [
                'judul' => 'Hutan Jati',
                'deskripsi' => 'Hutan jati yang rindang di Desa Kala',
                'gambar' => 'https://via.placeholder.com/400x300?text=Hutan+Jati',
                'kategori' => 'panorama',
                'album' => 'Panorama Desa',
                'tanggal' => '2023-10-25',
                'is_active' => true,
            ],
            [
                'judul' => 'Perbukitan Desa',
                'deskripsi' => 'Pemandangan perbukitan hijau di sekitar desa',
                'gambar' => 'https://via.placeholder.com/400x300?text=Perbukitan',
                'kategori' => 'panorama',
                'album' => 'Panorama Desa',
                'tanggal' => '2023-10-20',
                'is_active' => true,
            ],
        ];

        foreach ($galeriData as $data) {
            Galeri::create($data);
        }
    }
}
