<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Activity;
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
            'user_name' => 'required|string|max:191',
            'user_age' => 'required|integer|min:0|max:120',
            'gejala_ids' => 'required|array',
            'gejala_ids.*' => 'integer|exists:gejalas,id'
        ]);

        $selectedGejalaIds = $validated['gejala_ids'];
        $userName = $validated['user_name'];
        $userAge = $validated['user_age'];

        // Forward Chaining Logic
        $diagnosis = $this->forwardChaining($selectedGejalaIds);

        // Save activity log for admin review
        try {
            $user = auth()->user();
            $topSummary = null;
            if (is_array($diagnosis) && !empty($diagnosis)) {
                $first = reset($diagnosis);
                if (is_array($first) && isset($first['penyakit'])) {
                    $penyakitName = is_object($first['penyakit']) ? ($first['penyakit']->nama_penyakit ?? null) : ($first['penyakit']['nama_penyakit'] ?? null);
                    $confidence = $first['confidence'] ?? null;
                    $topSummary = trim(($penyakitName ?? '-') . ' (' . ($confidence !== null ? number_format($confidence, 2) : '-') . ')');
                }
            }

            // Normalize diagnosis data to arrays so JSON cast works reliably
            $normalizedDiagnosis = null;
            try {
                if (is_array($diagnosis)) {
                    $normalizedDiagnosis = array_map(function ($item) {
                        // If penyakit is Eloquent model, convert to simple array
                        if (isset($item['penyakit'])) {
                            if (is_object($item['penyakit'])) {
                                $item['penyakit'] = [
                                    'id' => $item['penyakit']->id ?? null,
                                    'nama_penyakit' => $item['penyakit']->nama_penyakit ?? null,
                                ];
                            }
                        }

                        // Ensure 'aturans' is array of strings
                        if (isset($item['aturans']) && is_array($item['aturans'])) {
                            $item['aturans'] = array_map('strval', $item['aturans']);
                        }

                        return $item;
                    }, $diagnosis);
                }
            } catch (\Throwable $t) {
                // fallback: stringify diagnosis
                $normalizedDiagnosis = ['raw' => json_encode($diagnosis)];
                \Log::warning('Diagnosis normalization fallback: ' . $t->getMessage());
            }

            $activity = Activity::create([
                'user_id' => $user->id ?? null,
                'user_name' => $userName,
                'user_age' => $userAge,
                'action' => 'diagnosis',
                'result_summary' => $topSummary,
                'diagnosis_data' => $normalizedDiagnosis,
                'selected_gejala' => $selectedGejalaIds,
            ]);

            if ($activity && $activity->id) {
                \Log::info('Activity created id: ' . $activity->id . ' for user: ' . ($activity->user_name ?? 'guest'));
                session()->flash('activity_id', $activity->id);
            } else {
                \Log::warning('Activity::create returned falsy result');
            }
        } catch (\Exception $e) {
            \Log::error('Failed to log activity in KonsultasiController: ' . $e->getMessage());
        }

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
