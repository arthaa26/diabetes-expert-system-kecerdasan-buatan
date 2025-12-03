<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gejala; // Pastikan Anda memiliki Model Gejala
use App\Models\Penyakit; // Pastikan Anda memiliki Model Penyakit
use App\Models\Aturan; // Pastikan Anda memiliki Model Aturan
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama untuk admin dengan ringkasan data sistem pakar.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Pastikan Model Gejala, Penyakit, dan Aturan sudah dibuat
        // dan dihubungkan dengan tabel database yang benar.

        try {
            // Menghitung total entitas dari database
            $gejalaCount = Gejala::count(); 
            $penyakitCount = Penyakit::count(); 
            $aturanCount = Aturan::count(); 
        } catch (\Exception $e) {
            // Log error jika ada masalah koneksi database atau model tidak ditemukan
            // Atau berikan nilai default 0
            $gejalaCount = 0;
            $penyakitCount = 0;
            $aturanCount = 0;
            \Log::error("Database count error in AdminDashboardController: " . $e->getMessage());
        }
        
        // Ambil aktivitas terbaru untuk ditampilkan di dashboard
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