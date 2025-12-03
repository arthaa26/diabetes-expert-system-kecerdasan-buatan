<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aturan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aturans = Aturan::with('penyakit')->orderBy('nama_aturan')->paginate(15);
        return view('admin.aturan.index', compact('aturans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penyakits = Penyakit::orderBy('nama_penyakit')->get();
        $gejalas = Gejala::orderBy('kode_gejala')->get();
        return view('admin.aturan.create', compact('penyakits', 'gejalas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_aturan' => 'required|string|max:255',
            'penyakit_id' => 'required|exists:penyakits,id',
            'confidence' => 'required|numeric|min:0|max:1',
        ]);

        Aturan::create($validated);

        return redirect()->route('admin.aturan.index')
            ->with('success', 'Aturan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aturan $aturan)
    {
        $aturan->load('penyakit', 'aturanDetails.gejala');
        return view('admin.aturan.show', compact('aturan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aturan $aturan)
    {
        $penyakits = Penyakit::orderBy('nama_penyakit')->get();
        $gejalas = Gejala::orderBy('kode_gejala')->get();
        return view('admin.aturan.edit', compact('aturan', 'penyakits', 'gejalas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aturan $aturan)
    {
        $validated = $request->validate([
            'nama_aturan' => 'required|string|max:255',
            'penyakit_id' => 'required|exists:penyakits,id',
            'confidence' => 'required|numeric|min:0|max:1',
        ]);

        $aturan->update($validated);

        return redirect()->route('admin.aturan.index')
            ->with('success', 'Aturan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aturan $aturan)
    {
        $aturan->delete();

        return redirect()->route('admin.aturan.index')
            ->with('success', 'Aturan berhasil dihapus.');
    }
}
