<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanans = [
            [
                'nama' => 'Surat Keterangan Domisili',
                'kategori' => 'administrasi',
                'deskripsi' => 'Surat yang menyatakan bahwa seseorang benar-benar bertempat tinggal di Desa Kala',
                'prosedur' => [
                    'Mengisi formulir permohonan',
                    'Menyerahkan fotocopy KTP dan KK',
                    'Verifikasi data oleh petugas',
                    'Pembayaran biaya administrasi',
                    'Pengambilan surat dalam 3 hari kerja'
                ],
                'syarat' => [
                    'Fotocopy KTP pemohon',
                    'Fotocopy Kartu Keluarga',
                    'Surat pengantar dari RT/RW',
                    'Biaya administrasi Rp 5.000'
                ],
                'waktu_proses' => '3 hari kerja',
                'biaya' => 'Rp 5.000',
                'kontak' => 'Kantor Desa Kala - Bagian Administrasi',
                'is_active' => true,
            ],
            [
                'nama' => 'Surat Keterangan Tidak Mampu',
                'kategori' => 'administrasi',
                'deskripsi' => 'Surat yang menyatakan bahwa seseorang atau keluarga dalam kondisi ekonomi tidak mampu',
                'prosedur' => [
                    'Mengisi formulir permohonan',
                    'Melampirkan surat pernyataan tidak mampu',
                    'Survei lapangan oleh petugas desa',
                    'Verifikasi data dan kondisi',
                    'Pengambilan surat dalam 5 hari kerja'
                ],
                'syarat' => [
                    'Fotocopy KTP pemohon',
                    'Fotocopy Kartu Keluarga',
                    'Surat pernyataan tidak mampu bermaterai',
                    'Surat pengantar RT/RW',
                    'Biaya administrasi Rp 10.000'
                ],
                'waktu_proses' => '5 hari kerja',
                'biaya' => 'Rp 10.000',
                'kontak' => 'Kantor Desa Kala - Bagian Kesejahteraan',
                'is_active' => true,
            ],
            [
                'nama' => 'Izin Usaha Mikro',
                'kategori' => 'perizinan',
                'deskripsi' => 'Izin untuk menjalankan usaha mikro dan kecil di wilayah Desa Kala',
                'prosedur' => [
                    'Mengisi formulir permohonan',
                    'Melampirkan proposal usaha',
                    'Presentasi rencana usaha',
                    'Verifikasi lokasi usaha',
                    'Pengambilan izin dalam 7 hari kerja'
                ],
                'syarat' => [
                    'Fotocopy KTP pemilik usaha',
                    'Proposal usaha sederhana',
                    'Surat pernyataan modal usaha',
                    'Surat pengantar RT/RW',
                    'Biaya administrasi Rp 25.000'
                ],
                'waktu_proses' => '7 hari kerja',
                'biaya' => 'Rp 25.000',
                'kontak' => 'Kantor Desa Kala - Bagian Pembangunan',
                'is_active' => true,
            ],
            [
                'nama' => 'Surat Keterangan Kematian',
                'kategori' => 'administrasi',
                'deskripsi' => 'Surat yang menyatakan bahwa seseorang telah meninggal dunia',
                'prosedur' => [
                    'Melaporkan kematian ke kantor desa',
                    'Mengisi formulir pelaporan',
                    'Melampirkan surat keterangan dari rumah sakit/dokter',
                    'Verifikasi data oleh petugas',
                    'Pengambilan surat dalam 1 hari kerja'
                ],
                'syarat' => [
                    'Surat keterangan kematian dari rumah sakit/dokter',
                    'Fotocopy KTP yang meninggal',
                    'Fotocopy Kartu Keluarga',
                    'Fotocopy KTP pelapor',
                    'Biaya administrasi Rp 5.000'
                ],
                'waktu_proses' => '1 hari kerja',
                'biaya' => 'Rp 5.000',
                'kontak' => 'Kantor Desa Kala - Bagian Administrasi',
                'is_active' => true,
            ],
            [
                'nama' => 'Surat Keterangan Lahir',
                'kategori' => 'administrasi',
                'deskripsi' => 'Surat yang menyatakan bahwa seseorang telah lahir di Desa Kala',
                'prosedur' => [
                    'Melaporkan kelahiran ke kantor desa',
                    'Mengisi formulir pelaporan',
                    'Melampirkan surat keterangan dari bidan/rumah sakit',
                    'Verifikasi data oleh petugas',
                    'Pengambilan surat dalam 1 hari kerja'
                ],
                'syarat' => [
                    'Surat keterangan lahir dari bidan/rumah sakit',
                    'Fotocopy KTP orang tua',
                    'Fotocopy Kartu Keluarga',
                    'Fotocopy KTP saksi',
                    'Biaya administrasi Rp 5.000'
                ],
                'waktu_proses' => '1 hari kerja',
                'biaya' => 'Rp 5.000',
                'kontak' => 'Kantor Desa Kala - Bagian Administrasi',
                'is_active' => true,
            ],
            [
                'nama' => 'Izin Keramaian',
                'kategori' => 'perizinan',
                'deskripsi' => 'Izin untuk mengadakan acara keramaian di wilayah Desa Kala',
                'prosedur' => [
                    'Mengisi formulir permohonan',
                    'Melampirkan proposal acara',
                    'Koordinasi dengan aparat keamanan',
                    'Verifikasi lokasi acara',
                    'Pengambilan izin dalam 3 hari kerja'
                ],
                'syarat' => [
                    'Fotocopy KTP penyelenggara',
                    'Proposal acara lengkap',
                    'Surat izin dari RT/RW setempat',
                    'Surat rekomendasi dari kepolisian',
                    'Biaya administrasi Rp 50.000'
                ],
                'waktu_proses' => '3 hari kerja',
                'biaya' => 'Rp 50.000',
                'kontak' => 'Kantor Desa Kala - Bagian Ketertiban',
                'is_active' => true,
            ]
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
