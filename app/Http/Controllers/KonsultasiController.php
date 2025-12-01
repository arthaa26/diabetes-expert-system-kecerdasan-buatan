<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Tampilkan halaman konsultasi dengan daftar gejala
     */
    public function index()
    {
        $gejalas = Gejala::all()->sortBy('kode_gejala');
        return view('konsultasi.index', compact('gejalas'));
    }

    /**
     * Forward Chaining Algorithm
     * Proses gejala yang dipilih dan berikan diagnosis
     */
    public function diagnose(Request $request)
    {
        $validated = $request->validate([
            'gejala_ids' => 'required|array',
            'gejala_ids.*' => 'integer|exists:gejalas,id'
        ]);

        $selectedGejalaIds = $validated['gejala_ids'];

        // Forward Chaining Logic
        $diagnosis = $this->forwardChaining($selectedGejalaIds);

        return view('konsultasi.result', compact('diagnosis', 'selectedGejalaIds'));
    }

    /**
     * Forward Chaining Algorithm Implementation
     * 
     * Algoritma:
     * 1. Ambil semua aturan dari database
     * 2. Untuk setiap aturan, cek apakah semua gejala dalam aturan ada di gejala yang dipilih
     * 3. Jika cocok, catat penyakit dan confidence-nya
     * 4. Urutkan berdasarkan confidence dan jumlah gejala yang cocok
     * 5. Kembalikan hasil diagnosis
     */
    private function forwardChaining($selectedGejalaIds)
    {
        $aturans = Aturan::with('aturanDetails.gejala', 'penyakit')->get();
        $matchedDiseases = [];

        foreach ($aturans as $aturan) {
            // Ambil semua gejala yang diperlukan oleh aturan ini
            $requiredGejalaIds = $aturan->aturanDetails->pluck('gejala_id')->toArray();

            // Hitung berapa banyak gejala yang cocok
            $matchedCount = count(array_intersect($requiredGejalaIds, $selectedGejalaIds));
            $totalRequired = count($requiredGejalaIds);

            // Jika semua gejala dalam aturan ada di gejala yang dipilih
            if ($matchedCount === $totalRequired && $totalRequired > 0) {
                $penyakitId = $aturan->penyakit_id;

                if (!isset($matchedDiseases[$penyakitId])) {
                    $matchedDiseases[$penyakitId] = [
                        'penyakit' => $aturan->penyakit,
                        'confidence' => $aturan->confidence,
                        'aturan_count' => 1,
                        'matched_gejala_count' => $matchedCount,
                        'aturans' => [$aturan->nama_aturan]
                    ];
                } else {
                    // Jika penyakit sudah ada, tingkatkan confidence
                    $matchedDiseases[$penyakitId]['aturan_count']++;
                    $matchedDiseases[$penyakitId]['confidence'] += $aturan->confidence;
                    $matchedDiseases[$penyakitId]['aturans'][] = $aturan->nama_aturan;
                }
            }
        }

        // Hitung rata-rata confidence dan urutkan
        foreach ($matchedDiseases as $penyakitId => &$data) {
            $data['confidence'] = min(100, $data['confidence'] / $data['aturan_count']);
        }

        // Urutkan berdasarkan confidence (descending)
        usort($matchedDiseases, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        // Jika tidak ada yang cocok, kembalikan risiko berdasarkan gejala yang ada
        if (empty($matchedDiseases)) {
            return $this->handleNoMatch($selectedGejalaIds);
        }

        return $matchedDiseases;
    }

    /**
     * Jika tidak ada aturan yang cocok sepenuhnya,
     * kembalikan diagnosis berdasarkan kecocokan sebagian
     */
    private function handleNoMatch($selectedGejalaIds)
    {
        $aturans = Aturan::with('aturanDetails.gejala', 'penyakit')->get();
        $partialMatches = [];

        foreach ($aturans as $aturan) {
            $requiredGejalaIds = $aturan->aturanDetails->pluck('gejala_id')->toArray();
            $matchedCount = count(array_intersect($requiredGejalaIds, $selectedGejalaIds));
            $totalRequired = count($requiredGejalaIds);

            if ($matchedCount > 0) {
                $matchPercentage = ($matchedCount / $totalRequired) * 100;
                $penyakitId = $aturan->penyakit_id;

                if (!isset($partialMatches[$penyakitId])) {
                    $partialMatches[$penyakitId] = [
                        'penyakit' => $aturan->penyakit,
                        'confidence' => $matchPercentage * ($aturan->confidence / 100),
                        'match_percentage' => $matchPercentage,
                        'aturans' => [$aturan->nama_aturan]
                    ];
                } else {
                    $partialMatches[$penyakitId]['confidence'] += $matchPercentage * ($aturan->confidence / 100);
                    $partialMatches[$penyakitId]['aturans'][] = $aturan->nama_aturan;
                }
            }
        }

        // Urutkan berdasarkan confidence
        usort($partialMatches, function ($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        return array_slice($partialMatches, 0, 2); // Return top 2 kemungkinan
    }
}
