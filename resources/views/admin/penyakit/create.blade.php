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
            <a href="{{ route('admin.penyakit.index') }}" class="text-blue-500 hover:text-blue-700">← Kembali ke Daftar Penyakit</a>
            <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Penyakit</h1>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.penyakit.store') }}" method="POST">
                @csrf

                <!-- Kode Penyakit -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Kode Penyakit</label>
                    <input type="text" name="kode_penyakit" placeholder="Contoh: P1, P2, ..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('kode_penyakit') }}" required>
                    @error('kode_penyakit')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Nama Penyakit -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" placeholder="Contoh: Diabetes Melitus Tipe 2" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('nama_penyakit') }}" required>
                    @error('nama_penyakit')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan deskripsi penyakit...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Penanganan -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Penanganan</label>
                    <textarea name="penanganan" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan rekomendasi penanganan...">{{ old('penanganan') }}</textarea>
                    @error('penanganan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
                        Simpan Penyakit
                    </button>
                    <a href="{{ route('admin.penyakit.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
