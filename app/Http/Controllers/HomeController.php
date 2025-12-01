<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda (Homepage) sistem pakar.
     * * @return \Illuminate\View\View
     */
    public function index()
    {
        // Pastikan Anda memiliki file view di: resources/views/home.blade.php
        return view('home'); 
    }
}