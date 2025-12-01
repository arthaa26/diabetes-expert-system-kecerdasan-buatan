<?php

namespace Database\Seeders;

use App\Models\Aturan;
use App\Models\AturanDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Forward Chaining Rules:
     * IF (gejala1 AND gejala2 AND gejala3 ...) THEN (penyakit)
     */
    public function run(): void
    {
        // ========== DIABETES TIPE 1 ==========
        // Aturan 1: Onset cepat dengan gejala klasik + usia muda
        $aturan1 = Aturan::create([
            'penyakit_id' => 1, // P1: Diabetes Tipe 1
            'nama_aturan' => 'IF (Sering Buang Air Kecil AND Cepat Lapar dan Haus AND Penurunan Berat Badan) THEN Diabetes Tipe 1',
            'confidence' => 85
        ]);
        $aturan1->aturanDetails()->createMany([
            ['gejala_id' => 1], // G1: Sering Buang Air Kecil
            ['gejala_id' => 3], // G3: Cepat Lapar dan Aust
            ['gejala_id' => 2]  // G2: Penurunan Berat Badan
        ]);

        // Aturan 2: Gejala klasik + kelelahan
        $aturan2 = Aturan::create([
            'penyakit_id' => 1,
            'nama_aturan' => 'IF (Sering Buang Air Kecil AND Kelelahan AND Penurunan Berat Badan) THEN Diabetes Tipe 1',
            'confidence' => 80
        ]);
        $aturan2->aturanDetails()->createMany([
            ['gejala_id' => 1], // G1
            ['gejala_id' => 4], // G4: Kelelahan
            ['gejala_id' => 2]  // G2
        ]);

        // Aturan 3: Gejala klasik + pandangan kabur
        $aturan3 = Aturan::create([
            'penyakit_id' => 1,
            'nama_aturan' => 'IF (Cepat Lapar dan Aust AND Penurunan Berat Badan AND Pandangan Kabur) THEN Diabetes Tipe 1',
            'confidence' => 75
        ]);
        $aturan3->aturanDetails()->createMany([
            ['gejala_id' => 3], // G3
            ['gejala_id' => 2], // G2
            ['gejala_id' => 5]  // G5: Pandangan Kabur
        ]);

        // ========== DIABETES TIPE 2 ==========
        // Aturan 4: Gejala klasik + faktor risiko (usia, berat badan, tekanan darah)
        $aturan4 = Aturan::create([
            'penyakit_id' => 2,
            'nama_aturan' => 'IF (Cepat Lapar dan Aust AND Usia di atas 45 Tahun AND Kelebihan Berat Badan) THEN Diabetes Tipe 2',
            'confidence' => 80
        ]);
        $aturan4->aturanDetails()->createMany([
            ['gejala_id' => 3], // G3
            ['gejala_id' => 17], // G17: Usia > 45
            ['gejala_id' => 18] // G18: Kelebihan BB
        ]);

        // Aturan 5: Sering buang air kecil + kelelahan + berat badan
        $aturan5 = Aturan::create([
            'penyakit_id' => 2,
            'nama_aturan' => 'IF (Sering Buang Air Kecil AND Kelelahan AND Kelebihan Berat Badan AND Gaya Hidup Tidak Aktif) THEN Diabetes Tipe 2',
            'confidence' => 75
        ]);
        $aturan5->aturanDetails()->createMany([
            ['gejala_id' => 1], // G1
            ['gejala_id' => 4], // G4
            ['gejala_id' => 18], // G18
            ['gejala_id' => 19] // G19: Gaya Hidup Tidak Aktif
        ]);

        // Aturan 6: Luka sulit sembuh + kesemutan + kelelahan
        $aturan6 = Aturan::create([
            'penyakit_id' => 2,
            'nama_aturan' => 'IF (Luka Sulit Sembuh AND Kesemutan pada Ekstremitas AND Infeksi Jamur Berulang) THEN Diabetes Tipe 2',
            'confidence' => 70
        ]);
        $aturan6->aturanDetails()->createMany([
            ['gejala_id' => 6], // G6: Luka Sulit Sembuh
            ['gejala_id' => 7], // G7: Kesemutan
            ['gejala_id' => 9]  // G9: Infeksi Jamur
        ]);

        // Aturan 7: Tekanan darah + kolesterol tinggi + riwayat keluarga
        $aturan7 = Aturan::create([
            'penyakit_id' => 2,
            'nama_aturan' => 'IF (Tekanan Darah Tinggi AND Kolesterol Tinggi AND Riwayat Keluarga Diabetes) THEN Diabetes Tipe 2',
            'confidence' => 72
        ]);
        $aturan7->aturanDetails()->createMany([
            ['gejala_id' => 14], // G14
            ['gejala_id' => 15], // G15
            ['gejala_id' => 13]  // G13: Riwayat Keluarga
        ]);

        // ========== DIABETES GESTASIONAL ==========
        // Aturan 8: Kehamilan sebelumnya dengan gejala
        $aturan8 = Aturan::create([
            'penyakit_id' => 3,
            'nama_aturan' => 'IF (Kehamilan Gestasional Sebelumnya AND Sering Buang Air Kecil AND Cepat Lapar dan Aust) THEN Diabetes Gestasional',
            'confidence' => 85
        ]);
        $aturan8->aturanDetails()->createMany([
            ['gejala_id' => 16], // G16
            ['gejala_id' => 1],  // G1
            ['gejala_id' => 3]   // G3
        ]);

        // Aturan 9: Gejala saat hamil + kelelahan
        $aturan9 = Aturan::create([
            'penyakit_id' => 3,
            'nama_aturan' => 'IF (Cepat Lapar dan Aust AND Kelelahan AND Kehamilan Gestasional Sebelumnya) THEN Diabetes Gestasional',
            'confidence' => 80
        ]);
        $aturan9->aturanDetails()->createMany([
            ['gejala_id' => 3],  // G3
            ['gejala_id' => 4],  // G4
            ['gejala_id' => 16]  // G16
        ]);

        // ========== PREDIABETES / RISIKO TINGGI ==========
        // Aturan 10: Faktor risiko tanpa gejala klasik
        $aturan10 = Aturan::create([
            'penyakit_id' => 4,
            'nama_aturan' => 'IF (Kelebihan Berat Badan AND Gaya Hidup Tidak Aktif AND Usia di atas 45 Tahun AND Riwayat Keluarga Diabetes) THEN Prediabetes',
            'confidence' => 78
        ]);
        $aturan10->aturanDetails()->createMany([
            ['gejala_id' => 18], // G18
            ['gejala_id' => 19], // G19
            ['gejala_id' => 17], // G17
            ['gejala_id' => 13]  // G13
        ]);

        // Aturan 11: Tekanan darah + kolesterol + berat badan
        $aturan11 = Aturan::create([
            'penyakit_id' => 4,
            'nama_aturan' => 'IF (Tekanan Darah Tinggi AND Kolesterol Tinggi AND Kelebihan Berat Badan) THEN Prediabetes',
            'confidence' => 75
        ]);
        $aturan11->aturanDetails()->createMany([
            ['gejala_id' => 14], // G14
            ['gejala_id' => 15], // G15
            ['gejala_id' => 18]  // G18
        ]);

        // Aturan 12: Gejala ringan + faktor risiko
        $aturan12 = Aturan::create([
            'penyakit_id' => 4,
            'nama_aturan' => 'IF (Cepat Lapar dan Aust AND Kelelahan AND Kelebihan Berat Badan AND Gaya Hidup Tidak Aktif) THEN Prediabetes',
            'confidence' => 70
        ]);
        $aturan12->aturanDetails()->createMany([
            ['gejala_id' => 3],  // G3
            ['gejala_id' => 4],  // G4
            ['gejala_id' => 18], // G18
            ['gejala_id' => 19]  // G19
        ]);
    }
}
