@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Gejala</h1>
                <p class="text-gray-600">Kelola pertanyaan/gejala untuk diagnosis</p>
            </div>
            <a href="{{ route('admin.gejala.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                + Tambah Gejala
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
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Nama Gejala</th>
                        <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($gejalas as $gejala)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm font-mono text-gray-800">{{ $gejala->kode_gejala }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $gejala->nama_gejala }}</td>
                            <td class="px-6 py-4 text-center text-sm">
                                <a href="{{ route('admin.gejala.edit', $gejala) }}" class="text-blue-500 hover:text-blue-700 font-medium">Edit</a>
                                <form action="{{ route('admin.gejala.destroy', $gejala) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin akan dihapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium ml-4">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                Tidak ada gejala. <a href="{{ route('admin.gejala.create') }}" class="text-blue-500">Buat gejala baru</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $gejalas->links() }}
        </div>
    </div>
</div>
@endsection
