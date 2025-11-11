<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        // Data galeri dummy berdasarkan album/kategori
        $galeri = [
            [
                'album' => 'Kegiatan Desa',
                'kategori' => 'kegiatan',
                'deskripsi' => 'Dokumentasi berbagai kegiatan yang dilaksanakan di Desa Kala',
                'foto' => [
                    [
                        'id' => 1,
                        'judul' => 'Gotong Royong Bersih Desa',
                        'url' => 'https://via.placeholder.com/400x300?text=Gotong+Royong',
                        'tanggal' => '2023-11-15',
                        'deskripsi' => 'Kegiatan gotong royong membersihkan lingkungan desa yang diikuti oleh seluruh warga'
                    ],
                    [
                        'id' => 2,
                        'judul' => 'Pelatihan Wirausaha',
                        'url' => 'https://via.placeholder.com/400x300?text=Pelatihan+Wirausaha',
                        'tanggal' => '2023-11-10',
                        'deskripsi' => 'Pelatihan keterampilan wirausaha bagi pemuda desa'
                    ],
                    [
                        'id' => 3,
                        'judul' => 'Posyandu Balita',
                        'url' => 'https://via.placeholder.com/400x300?text=Posyandu+Balita',
                        'tanggal' => '2023-11-08',
                        'deskripsi' => 'Kegiatan posyandu rutin untuk kesehatan balita dan ibu hamil'
                    ],
                    [
                        'id' => 4,
                        'judul' => 'Kegiatan Karang Taruna',
                        'url' => 'https://via.placeholder.com/400x300?text=Karang+Taruna',
                        'tanggal' => '2023-11-05',
                        'deskripsi' => 'Kegiatan sosial Karang Taruna Desa Kala'
                    ]
                ]
            ],
            [
                'album' => 'Pembangunan Infrastruktur',
                'kategori' => 'pembangunan',
                'deskripsi' => 'Dokumentasi pembangunan infrastruktur desa',
                'foto' => [
                    [
                        'id' => 5,
                        'judul' => 'Pembangunan Jalan Desa',
                        'url' => 'https://via.placeholder.com/400x300?text=Pembangunan+Jalan',
                        'tanggal' => '2023-10-20',
                        'deskripsi' => 'Proses pembangunan jalan paving di Dusun Kala Indah'
                    ],
                    [
                        'id' => 6,
                        'judul' => 'Renovasi Balai Desa',
                        'url' => 'https://via.placeholder.com/400x300?text=Renovasi+Balai',
                        'tanggal' => '2023-10-15',
                        'deskripsi' => 'Renovasi gedung balai desa dengan dana desa'
                    ],
                    [
                        'id' => 7,
                        'judul' => 'Pembangunan Sumur Bor',
                        'url' => 'https://via.placeholder.com/400x300?text=Sumur+Bor',
                        'tanggal' => '2023-10-10',
                        'deskripsi' => 'Pembangunan sumur bor untuk sumber air bersih warga'
                    ],
                    [
                        'id' => 8,
                        'judul' => 'Pemasangan Listrik',
                        'url' => 'https://via.placeholder.com/400x300?text=Pemasangan+Listrik',
                        'tanggal' => '2023-10-05',
                        'deskripsi' => 'Pemasangan jaringan listrik ke rumah-rumah warga'
                    ]
                ]
            ],
            [
                'album' => 'Event dan Festival',
                'kategori' => 'event',
                'deskripsi' => 'Dokumentasi event dan festival yang diadakan di desa',
                'foto' => [
                    [
                        'id' => 9,
                        'judul' => 'Festival Desa Kala',
                        'url' => 'https://via.placeholder.com/400x300?text=Festival+Desa',
                        'tanggal' => '2023-09-25',
                        'deskripsi' => 'Festival budaya dan kuliner Desa Kala'
                    ],
                    [
                        'id' => 10,
                        'judul' => 'Hari Kemerdekaan',
                        'url' => 'https://via.placeholder.com/400x300?text=Hari+Kemerdekaan',
                        'tanggal' => '2023-08-17',
                        'deskripsi' => 'Peringatan Hari Kemerdekaan RI di Desa Kala'
                    ],
                    [
                        'id' => 11,
                        'judul' => 'Pesta Panen',
                        'url' => 'https://via.placeholder.com/400x300?text=Pesta+Panen',
                        'tanggal' => '2023-08-10',
                        'deskripsi' => 'Pesta panen raya Desa Kala'
                    ],
                    [
                        'id' => 12,
                        'judul' => 'Festival Kesenian',
                        'url' => 'https://via.placeholder.com/400x300?text=Festival+Kesenian',
                        'tanggal' => '2023-07-20',
                        'deskripsi' => 'Festival kesenian tradisional Desa Kala'
                    ]
                ]
            ],
            [
                'album' => 'Panorama Desa',
                'kategori' => 'panorama',
                'deskripsi' => 'Keindahan panorama dan pemandangan Desa Kala',
                'foto' => [
                    [
                        'id' => 13,
                        'judul' => 'Pemandangan Sawah',
                        'url' => 'https://via.placeholder.com/400x300?text=Pemandangan+Sawah',
                        'tanggal' => '2023-11-01',
                        'deskripsi' => 'Pemandangan sawah hijau di pagi hari'
                    ],
                    [
                        'id' => 14,
                        'judul' => 'Air Terjun Kala',
                        'url' => 'https://via.placeholder.com/400x300?text=Air+Terjun',
                        'tanggal' => '2023-10-28',
                        'deskripsi' => 'Keindahan Air Terjun Kala dari kejauhan'
                    ],
                    [
                        'id' => 15,
                        'judul' => 'Hutan Jati',
                        'url' => 'https://via.placeholder.com/400x300?text=Hutan+Jati',
                        'tanggal' => '2023-10-25',
                        'deskripsi' => 'Hutan jati yang rindang di Desa Kala'
                    ],
                    [
                        'id' => 16,
                        'judul' => 'Perbukitan Desa',
                        'url' => 'https://via.placeholder.com/400x300?text=Perbukitan',
                        'tanggal' => '2023-10-20',
                        'deskripsi' => 'Pemandangan perbukitan hijau di sekitar desa'
                    ]
                ]
            ]
        ];

        // Kategori yang tersedia
        $kategoriList = ['semua', 'kegiatan', 'pembangunan', 'event', 'panorama'];

        return view('galeri-desa', compact('galeri', 'kategoriList'));
    }
}
