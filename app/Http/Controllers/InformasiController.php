<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformasiController extends Controller
{
    /**
     * Menampilkan halaman informasi kesehatan.
     */
    public function index()
    {
        return view('informasi');
    }
}
