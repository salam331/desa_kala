<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $berita = [
            [
                'judul' => 'Pelatihan Wirausaha Muda di Desa Kala',
                'kategori' => 'pembangunan',
                'tanggal' => '2023-11-15',
                'ringkasan' => 'Program pelatihan wirausaha untuk meningkatkan keterampilan warga desa.',
                'konten' => 'Desa Kala menyelenggarakan program pelatihan wirausaha muda yang bertujuan untuk meningkatkan keterampilan dan kemampuan warga dalam bidang entrepreneurship. Program ini diikuti oleh 50 peserta dari berbagai kalangan usia produktif. Pelatihan mencakup materi tentang manajemen usaha, pemasaran digital, dan pengembangan produk lokal. Kegiatan ini merupakan bagian dari upaya pemerintah desa untuk mendorong pertumbuhan ekonomi masyarakat.',
                'gambar' => 'https://via.placeholder.com/400x250?text=Pelatihan+Wirausaha'
            ],
            [
                'judul' => 'Gotong Royong Bersih Lingkungan',
                'kategori' => 'sosial',
                'tanggal' => '2023-11-10',
                'ringkasan' => 'Kegiatan bersih-bersih lingkungan dilakukan setiap hari Minggu.',
                'konten' => 'Warga Desa Kala secara rutin melaksanakan kegiatan gotong royong bersih lingkungan setiap hari Minggu pagi. Kegiatan ini melibatkan seluruh komponen masyarakat mulai dari anak-anak hingga orang tua. Bersama-sama membersihkan jalan-jalan desa, saluran irigasi, dan area publik lainnya. Kegiatan ini tidak hanya menjaga kebersihan lingkungan tetapi juga mempererat tali silaturahmi antar warga.',
                'gambar' => 'https://via.placeholder.com/400x250?text=Gotong+Royong'
            ],
            [
                'judul' => 'Panen Padi Raya di Lahan Pertanian Desa',
                'kategori' => 'pertanian',
                'tanggal' => '2023-11-08',
                'ringkasan' => 'Petani desa berhasil panen padi dengan hasil melimpah.',
                'konten' => 'Petani Desa Kala merayakan panen padi raya dengan hasil yang sangat memuaskan. Musim panen kali ini menghasilkan 200 ton beras yang akan didistribusikan ke pasar lokal dan program bantuan pangan. Keberhasilan ini tidak lepas dari dukungan program pertanian berkelanjutan yang dicanangkan oleh pemerintah desa, termasuk penyuluhan pertanian modern dan bantuan pupuk organik.',
                'gambar' => 'https://via.placeholder.com/400x250?text=Panen+Padi'
            ],
            [
                'judul' => 'Pembangunan Jalan Desa Selesai 100%',
                'kategori' => 'pembangunan',
                'tanggal' => '2023-11-05',
                'ringkasan' => 'Proyek pembangunan jalan desa telah selesai dan diresmikan.',
                'konten' => 'Pemerintah Desa Kala telah menyelesaikan proyek pembangunan jalan desa sepanjang 2 kilometer. Proyek ini dibiayai dari APBDes dan bantuan kabupaten. Pembangunan jalan ini diharapkan dapat meningkatkan aksesibilitas warga ke pusat desa dan memperlancar distribusi hasil pertanian. Peresmian dilakukan oleh Kepala Desa bersama perangkat desa dan tokoh masyarakat.',
                'gambar' => 'https://via.placeholder.com/400x250?text=Pembangunan+Jalan'
            ],
            [
                'judul' => 'Festival Budaya Desa Kala',
                'kategori' => 'sosial',
                'tanggal' => '2023-11-01',
                'ringkasan' => 'Festival budaya tahunan desa menampilkan berbagai kesenian lokal.',
                'konten' => 'Festival Budaya Desa Kala yang diselenggarakan setiap tahun telah sukses digelar. Acara ini menampilkan berbagai kesenian tradisional seperti tari daerah, musik gamelan, dan pertunjukan wayang kulit. Festival ini menjadi ajang silaturahmi antar warga dan juga promosi potensi budaya desa kepada masyarakat luar. Ribuan pengunjung hadir menyaksikan berbagai atraksi budaya yang disajikan.',
                'gambar' => 'https://via.placeholder.com/400x250?text=Festival+Budaya'
            ]
        ];

        foreach ($berita as $item) {
            Berita::create($item);
        }
    }
}
