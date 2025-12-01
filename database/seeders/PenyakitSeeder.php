<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakits = [
            [
                'kode_penyakit' => 'P1',
                'nama_penyakit' => 'Diabetes Tipe 1',
                'deskripsi' => 'Diabetes Tipe 1 adalah kondisi autoimun di mana pankreas tidak memproduksi insulin yang cukup atau sama sekali. Biasanya terjadi pada anak-anak dan dewasa muda, meskipun dapat berkembang di usia berapa pun. Memerlukan terapi insulin seumur hidup.',
                'penanganan' => 'Injeksi insulin harian, pemantauan kadar gula darah secara rutin, pola makan sehat, olahraga teratur, dan konsultasi dengan dokter endokrinologi.'
            ],
            [
                'kode_penyakit' => 'P2',
                'nama_penyakit' => 'Diabetes Tipe 2',
                'deskripsi' => 'Diabetes Tipe 2 adalah kondisi di mana tubuh tidak dapat menggunakan insulin secara efektif (resistensi insulin). Ini adalah tipe diabetes paling umum dan sering dikaitkan dengan gaya hidup dan faktor genetik.',
                'penanganan' => 'Perubahan gaya hidup (diet sehat, olahraga), obat-obatan oral (metformin, sulfonilurea), pemantauan gula darah, dan edukasi nutrisi. Terapi insulin mungkin diperlukan pada kasus lanjut.'
            ],
            [
                'kode_penyakit' => 'P3',
                'nama_penyakit' => 'Diabetes Gestasional',
                'deskripsi' => 'Diabetes gestasional terjadi selama kehamilan ketika tubuh tidak dapat mengelola peningkatan kebutuhan insulin. Biasanya hilang setelah melahirkan, tetapi meningkatkan risiko Diabetes Tipe 2 di kemudian hari.',
                'penanganan' => 'Manajemen diet khusus untuk ibu hamil, pemantauan kadar gula darah, olahraga ringan yang aman untuk kehamilan, dan terapi insulin jika diperlukan. Pemantauan pascanatal untuk diabetes.'
            ],
            [
                'kode_penyakit' => 'P4',
                'nama_penyakit' => 'Prediabetes / Risiko Tinggi',
                'deskripsi' => 'Prediabetes adalah kondisi di mana kadar gula darah lebih tinggi dari normal tetapi belum mencapai tingkat diabetes. Ini adalah tanda peringatan bahwa Anda berisiko mengembangkan Diabetes Tipe 2.',
                'penanganan' => 'Perubahan gaya hidup agresif termasuk diet sehat, olahraga 150 menit per minggu, penurunan berat badan 5-10%, berhenti merokok, dan pemantauan gula darah secara berkala. Konsultasi dengan ahli gizi.'
            ]
        ];

        foreach ($penyakits as $penyakit) {
            Penyakit::create($penyakit);
        }
    }
}
