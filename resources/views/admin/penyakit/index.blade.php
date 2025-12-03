@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700 font-medium">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Dashboard
            </a>
        </div>
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Penyakit</h1>
                <p class="text-gray-600">Kelola data penyakit dalam sistem pakar</p>
            </div>
            <a href="{{ route('admin.penyakit.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                + Tambah Penyakit
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Kode</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Nama Penyakit</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Deskripsi</th>
                        <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($penyakits as $penyakit)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-mono text-gray-800">{{ $penyakit->kode_penyakit }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $penyakit->nama_penyakit }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($penyakit->deskripsi, 50) }}</td>
                            <td class="px-6 py-4 text-center text-sm">
                                <a href="{{ route('admin.penyakit.edit', $penyakit) }}" class="text-blue-500 hover:text-blue-700 font-medium">Edit</a>
                                <form action="{{ route('admin.penyakit.destroy', $penyakit) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin akan dihapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium ml-4">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Tidak ada penyakit. <a href="{{ route('admin.penyakit.create') }}" class="text-blue-500">Buat penyakit baru</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $penyakits->links() }}
        </div>
    </div>
</div>
@endsection
