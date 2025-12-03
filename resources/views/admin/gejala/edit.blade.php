@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium mb-3">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Dashboard
            </a>
            <a href="{{ route('admin.gejala.index') }}" class="text-blue-500 hover:text-blue-700">← Kembali ke Daftar Gejala</a>
            <h1 class="text-3xl font-bold text-gray-800 mt-2">Edit Gejala</h1>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.gejala.update', $gejala) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Kode Gejala -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Kode Gejala</label>
                    <input type="text" name="kode_gejala" placeholder="Contoh: G1, G2, ..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('kode_gejala', $gejala->kode_gejala) }}" required>
                    @error('kode_gejala')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama Gejala -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Nama Gejala (Pertanyaan)</label>
                    <textarea name="nama_gejala" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('nama_gejala', $gejala->nama_gejala) }}</textarea>
                    @error('nama_gejala')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                        Update Gejala
                    </button>
                    <a href="{{ route('admin.gejala.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
