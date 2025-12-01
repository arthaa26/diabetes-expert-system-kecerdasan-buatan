<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejalas = [
            // Gejala utama diabetes
            [
                'kode_gejala' => 'G1',
                'nama_gejala' => 'Sering Buang Air Kecil',
                'deskripsi' => 'Peningkatan frekuensi berkemih, terutama pada malam hari (Poliuria)'
            ],
            [
                'kode_gejala' => 'G2',
                'nama_gejala' => 'Penurunan Berat Badan Tiba-Tiba',
                'deskripsi' => 'Berat badan yang menyusut drastis tanpa perubahan pola makan'
            ],
            [
                'kode_gejala' => 'G3',
                'nama_gejala' => 'Cepat Lapar dan Haus',
                'deskripsi' => 'Rasa haus berlebihan dan nafsu makan yang terus meningkat (Polifagia dan Polidipsia)'
            ],
            
            // Gejala tambahan
            [
                'kode_gejala' => 'G4',
                'nama_gejala' => 'Kelelahan dan Kelemahan',
                'deskripsi' => 'Merasa selalu lelah, tidak bertenaga, dan lemah'
            ],
            [
                'kode_gejala' => 'G5',
                'nama_gejala' => 'Pandangan Kabur',
                'deskripsi' => 'Penglihatan menjadi kabur atau buram'
            ],
            [
                'kode_gejala' => 'G6',
                'nama_gejala' => 'Luka Sulit Sembuh',
                'deskripsi' => 'Luka atau goresan membutuhkan waktu lama untuk sembuh'
            ],
            [
                'kode_gejala' => 'G7',
                'nama_gejala' => 'Kesemutan pada Ekstremitas',
                'deskripsi' => 'Sensasi kesemutan atau baal pada tangan, kaki, atau jari'
            ],
            [
                'kode_gejala' => 'G8',
                'nama_gejala' => 'Kulit Gatal',
                'deskripsi' => 'Kulit terasa gatal tanpa alasan yang jelas'
            ],
            [
                'kode_gejala' => 'G9',
                'nama_gejala' => 'Infeksi Jamur Berulang',
                'deskripsi' => 'Sering mengalami infeksi jamur di area kelamin atau kulit'
            ],
            [
                'kode_gejala' => 'G10',
                'nama_gejala' => 'Gusi Berdarah',
                'deskripsi' => 'Gusi mudah berdarah saat menyikat gigi atau makan'
            ],
            [
                'kode_gejala' => 'G11',
                'nama_gejala' => 'Mulut Kering',
                'deskripsi' => 'Mulut terasa kering sepanjang waktu'
            ],
            [
                'kode_gejala' => 'G12',
                'nama_gejala' => 'Sakit Kepala Sering',
                'deskripsi' => 'Sakit kepala yang sering terjadi dan persisten'
            ],
            [
                'kode_gejala' => 'G13',
                'nama_gejala' => 'Riwayat Keluarga Diabetes',
                'deskripsi' => 'Ada anggota keluarga yang menderita diabetes'
            ],
            [
                'kode_gejala' => 'G14',
                'nama_gejala' => 'Tekanan Darah Tinggi',
                'deskripsi' => 'Tekanan darah konsisten lebih dari 130/80 mmHg'
            ],
            [
                'kode_gejala' => 'G15',
                'nama_gejala' => 'Kolesterol Tinggi',
                'deskripsi' => 'Kadar kolesterol total di atas 200 mg/dL'
            ],
            [
                'kode_gejala' => 'G16',
                'nama_gejala' => 'Kehamilan Gestasional Sebelumnya',
                'deskripsi' => 'Pernah mengalami diabetes gestasional saat hamil'
            ],
            [
                'kode_gejala' => 'G17',
                'nama_gejala' => 'Usia di atas 45 Tahun',
                'deskripsi' => 'Berusia 45 tahun atau lebih'
            ],
            [
                'kode_gejala' => 'G18',
                'nama_gejala' => 'Kelebihan Berat Badan (IMT > 25)',
                'deskripsi' => 'Indeks Massa Tubuh lebih dari 25'
            ],
            [
                'kode_gejala' => 'G19',
                'nama_gejala' => 'Gaya Hidup Tidak Aktif',
                'deskripsi' => 'Jarang berolahraga dan banyak duduk'
            ]
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
