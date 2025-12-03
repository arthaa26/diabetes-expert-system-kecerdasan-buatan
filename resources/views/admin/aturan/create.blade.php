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
            <a href="{{ route('admin.aturan.index') }}" class="text-blue-500 hover:text-blue-700">← Kembali ke Daftar Aturan</a>
            <h1 class="text-3xl font-bold text-gray-800 mt-2">Tambah Aturan</h1>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.aturan.store') }}" method="POST">
                @csrf

                <!-- Nama Aturan -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Aturan</label>
                    <input type="text" name="nama_aturan" placeholder="Contoh: Aturan Diabetes Tipe 2" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('nama_aturan') }}" required>
                    @error('nama_aturan')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Penyakit -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Penyakit (Hasil IF-THEN)</label>
                    <select name="penyakit_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach($penyakits as $penyakit)
                            <option value="{{ $penyakit->id }}" {{ old('penyakit_id') == $penyakit->id ? 'selected' : '' }}>
                                {{ $penyakit->nama_penyakit }}
                            </option>
                        @endforeach
                    </select>
                    @error('penyakit_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confidence -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Confidence (0.0 - 1.0)</label>
                    <input type="number" name="confidence" step="0.01" min="0" max="1" placeholder="Contoh: 0.95" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ old('confidence') }}" required>
                    <p class="text-gray-500 text-sm mt-1">Tingkat kepercayaan aturan ini (0 = tidak yakin, 1 = sangat yakin)</p>
                    @error('confidence')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">
                        Simpan Aturan
                    </button>
                    <a href="{{ route('admin.aturan.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
