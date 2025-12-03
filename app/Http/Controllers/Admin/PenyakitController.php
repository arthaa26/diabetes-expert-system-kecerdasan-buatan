<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyakits = Penyakit::orderBy('kode_penyakit')->paginate(15);
        return view('admin.penyakit.index', compact('penyakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penyakit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_penyakit' => 'required|string|unique:penyakits,kode_penyakit|max:10',
            'nama_penyakit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penanganan' => 'nullable|string',
        ]);

        Penyakit::create($validated);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyakit $penyakit)
    {
        return view('admin.penyakit.show', compact('penyakit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyakit $penyakit)
    {
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        $validated = $request->validate([
            'kode_penyakit' => 'required|string|unique:penyakits,kode_penyakit,' . $penyakit->id . '|max:10',
            'nama_penyakit' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'penanganan' => 'nullable|string',
        ]);

        $penyakit->update($validated);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil dihapus.');
    }
}
