<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Aturan;
use App\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin dengan data dari database.
     */
    public function index()
    {
        try {
            // Menghitung total entitas dari database
            $gejalaCount = Gejala::count();
            $penyakitCount = Penyakit::count();
            $aturanCount = Aturan::count();
        } catch (\Exception $e) {
            // Log error jika ada masalah koneksi database atau model tidak ditemukan
            $gejalaCount = 0;
            $penyakitCount = 0;
            $aturanCount = 0;
            \Log::error("Database count error in DashboardController: " . $e->getMessage());
        }

        // Ambil aktivitas terbaru untuk ditampilkan di dashboard (jika ada)
        $activities = [];
        try {
            $activities = Activity::with('user')->latest()->limit(10)->get();
        } catch (\Exception $e) {
            \Log::error('Failed to load activities for dashboard: ' . $e->getMessage());
        }

        // Mengirimkan data hitungan ke view
        return view('admin.dashboard', [
            'gejalaCount' => $gejalaCount,
            'penyakitCount' => $penyakitCount,
            'aturanCount' => $aturanCount,
            'activities' => $activities,
        ]);
    }
}
