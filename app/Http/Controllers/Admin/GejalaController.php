<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of gejala (symptoms/questions)
     */
    public function index()
    {
        $gejalas = Gejala::orderBy('kode_gejala')->paginate(15);
        return view('admin.gejala.index', compact('gejalas'));
    }

    /**
     * Show the form for creating a new gejala
     */
    public function create()
    {
        return view('admin.gejala.create');
    }

    /**
     * Store a newly created gejala in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_gejala' => 'required|string|unique:gejalas,kode_gejala|max:10',
            'nama_gejala' => 'required|string|max:255',
        ]);

        Gejala::create($validated);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil ditambahkan.');
    }

    /**
     * Display the specified gejala
     */
    public function show(Gejala $gejala)
    {
        return view('admin.gejala.show', compact('gejala'));
    }

    /**
     * Show the form for editing the specified gejala
     */
    public function edit(Gejala $gejala)
    {
        return view('admin.gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified gejala in storage
     */
    public function update(Request $request, Gejala $gejala)
    {
        $validated = $request->validate([
            'kode_gejala' => 'required|string|unique:gejalas,kode_gejala,' . $gejala->id . '|max:10',
            'nama_gejala' => 'required|string|max:255',
        ]);

        $gejala->update($validated);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil diubah.');
    }

    /**
     * Remove the specified gejala from storage
     */
    public function destroy(Gejala $gejala)
    {
        $gejala->delete();

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil dihapus.');
    }
}
