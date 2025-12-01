<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Menampilkan halaman kontak.
     */
    public function index()
    {
        return view('kontak');
    }

    /**
     * Simpan pesan kontak.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string|min:10',
        ]);

        // TODO: Simpan ke database atau kirim email
        
        return back()->with('success', 'Pesan Anda telah dikirim. Terima kasih!');
    }
}
