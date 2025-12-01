<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KonsultasiDiagnosisTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function konsultasi_returns_expected_diagnosis_for_classic_symptoms()
    {
        // Seed the gejala, penyakit and aturan to get deterministic results
        $this->seed(\Database\Seeders\GejalaSeeder::class);
        $this->seed(\Database\Seeders\PenyakitSeeder::class);
        $this->seed(\Database\Seeders\AturanSeeder::class);

        // Classic triad (G1, G2, G3) in our seeder maps to Diabetes Tipe 1
        $response = $this->post(route('konsultasi.diagnose'), [
            'gejala_ids' => [1, 2, 3],
        ]);

        $response->assertStatus(200);
        $response->assertSee('Diabetes Tipe 1');
    }
}
