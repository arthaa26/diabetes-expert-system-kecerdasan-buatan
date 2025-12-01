<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Aturan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $gejalaCount = Gejala::count();
        $penyakitCount = Penyakit::count();
        $aturanCount = Aturan::count();

        return view('admin.dashboard', compact('gejalaCount', 'penyakitCount', 'aturanCount'));
    }
}
