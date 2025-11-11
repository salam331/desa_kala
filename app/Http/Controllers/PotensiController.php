<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PotensiController extends Controller
{
    public function index()
    {
        // Data potensi desa dummy
        $potensi = [
            [
                'id' => 1,
                'nama' => 'Pertanian Padi',
                'kategori' => 'pertanian',
                'deskripsi' => 'Desa Kala memiliki lahan pertanian yang subur dengan hasil panen padi yang melimpah. Petani setempat menggunakan metode pertanian modern dan organik.',
                'detail' => 'Lahan pertanian di Desa Kala mencapai 800 hektar yang sebagian besar ditanami padi. Hasil panen rata-rata mencapai 6-7 ton per hektar per musim. Petani telah mengadopsi teknologi pertanian modern seperti penggunaan bibit unggul dan pupuk organik.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Pertanian+Padi',
                'kontak' => 'Bapak Sumarno - Ketua Kelompok Tani Makmur Sentosa',
                'telepon' => '(021) 123-4568',
                'lokasi' => 'Lahan Sawah Dusun Kala Indah'
            ],
            [
                'id' => 2,
                'nama' => 'Peternakan Sapi',
                'kategori' => 'peternakan',
                'deskripsi' => 'Peternakan sapi potong yang dikelola secara modern dengan sistem kandang tertutup dan pakan berkualitas.',
                'detail' => 'Peternakan sapi di Desa Kala memiliki kapasitas 200 ekor sapi potong. Sistem peternakan menggunakan teknologi modern dengan kandang tertutup dan pakan fermentasi. Produk daging sapi lokal telah terkenal di pasar kabupaten.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Peternakan+Sapi',
                'kontak' => 'Ibu Ratna Sari - Pengelola Peternakan Kala Jaya',
                'telepon' => '(021) 123-4569',
                'lokasi' => 'Peternakan Dusun Kala Makmur'
            ],
            [
                'id' => 3,
                'nama' => 'UMKM Kerajinan Bambu',
                'kategori' => 'umkm',
                'deskripsi' => 'Kerajinan tangan dari bambu yang diproduksi oleh kelompok wanita desa dengan kualitas ekspor.',
                'detail' => 'Kelompok UMKM kerajinan bambu "Bambu Kala" telah beroperasi sejak 2015. Produk yang dihasilkan antara lain furniture, souvenir, dan kerajinan hias. Telah mengekspor ke beberapa negara tetangga dan mendapat penghargaan dari pemerintah.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Kerajinan+Bambu',
                'kontak' => 'Ibu Siti Aminah - Ketua UMKM Bambu Kala',
                'telepon' => '(021) 123-4570',
                'lokasi' => 'Workshop Dusun Kala Sejahtera'
            ],
            [
                'id' => 4,
                'nama' => 'Wisata Air Terjun Kala',
                'kategori' => 'wisata',
                'deskripsi' => 'Air terjun alami dengan ketinggian 30 meter yang menjadi destinasi wisata favorit di Desa Kala.',
                'detail' => 'Air Terjun Kala merupakan objek wisata alam yang terletak di perbukitan Desa Kala. Dengan ketinggian 30 meter dan debit air yang cukup besar sepanjang tahun, air terjun ini menawarkan pemandangan yang indah dan udara yang sejuk.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Air+Terjun+Kala',
                'kontak' => 'Bapak Ahmad Rahman - Pengelola Wisata Desa Kala',
                'telepon' => '(021) 123-4571',
                'lokasi' => 'Perbukitan Dusun Kala Alam'
            ],
            [
                'id' => 5,
                'nama' => 'Hutan Jati',
                'kategori' => 'sumber_daya_alam',
                'deskripsi' => 'Hutan jati yang dikelola secara berkelanjutan sebagai sumber kayu dan ekowisata.',
                'detail' => 'Hutan Jati Desa Kala seluas 150 hektar merupakan hutan tanaman yang dikelola secara berkelanjutan. Selain sebagai sumber kayu, hutan ini juga berfungsi sebagai area konservasi dan ekowisata dengan jalur trekking yang aman.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Hutan+Jati',
                'kontak' => 'Bapak Hadi Susanto - Pengawas Hutan Desa',
                'telepon' => '(021) 123-4572',
                'lokasi' => 'Hutan Lindung Dusun Kala Hijau'
            ],
            [
                'id' => 6,
                'nama' => 'Perkebunan Kopi',
                'kategori' => 'pertanian',
                'deskripsi' => 'Perkebunan kopi arabika yang menghasilkan biji kopi berkualitas tinggi dengan cita rasa khas.',
                'detail' => 'Perkebunan kopi di Desa Kala terletak di dataran tinggi dengan ketinggian 800-1000 mdpl. Kopi arabika yang dihasilkan memiliki cita rasa unik dan telah mendapat sertifikasi organik. Produksi mencapai 50 ton biji kopi per tahun.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Perkebunan+Kopi',
                'kontak' => 'Bapak Joko Widodo - Ketua Koperasi Kopi Kala',
                'telepon' => '(021) 123-4573',
                'lokasi' => 'Perkebunan Dusun Kala Tinggi'
            ],
            [
                'id' => 7,
                'nama' => 'Peternakan Lele',
                'kategori' => 'peternakan',
                'deskripsi' => 'Budidaya ikan lele dengan sistem bioflok yang modern dan ramah lingkungan.',
                'detail' => 'Peternakan lele di Desa Kala menggunakan sistem bioflok yang ramah lingkungan. Dengan kapasitas 20 kolam, produksi mencapai 2 ton ikan lele per bulan. Produk dijual ke pasar lokal dan telah mendapat sertifikasi halal.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Peternakan+Lele',
                'kontak' => 'Ibu Maya Sari - Pengelola Tambak Lele Kala',
                'telepon' => '(021) 123-4574',
                'lokasi' => 'Tambak Dusun Kala Bahari'
            ],
            [
                'id' => 8,
                'nama' => 'UMKM Makanan Olahan',
                'kategori' => 'umkm',
                'deskripsi' => 'Produksi makanan olahan tradisional seperti keripik, dodol, dan sambal yang telah terkenal di daerah.',
                'detail' => 'UMKM makanan olahan "Kala Food" memproduksi berbagai jenis makanan tradisional dengan bahan baku lokal. Produk unggulan adalah keripik pisang, dodol durian, dan sambal terasi. Telah memiliki sertifikasi halal dan BPOM.',
                'gambar' => 'https://via.placeholder.com/400x300?text=Makanan+Olahan',
                'kontak' => 'Ibu Nurhayati - Pemilik Kala Food',
                'telepon' => '(021) 123-4575',
                'lokasi' => 'Produksi Dusun Kala Rasa'
            ]
        ];

        // Kategori yang tersedia
        $kategoriList = ['semua', 'pertanian', 'peternakan', 'umkm', 'wisata', 'sumber_daya_alam'];

        return view('potensi-desa', compact('potensi', 'kategoriList'));
    }
}
