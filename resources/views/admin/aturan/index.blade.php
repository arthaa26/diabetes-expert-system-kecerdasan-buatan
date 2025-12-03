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
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Aturan</h1>
                <p class="text-gray-600">Kelola aturan sistem pakar (IF-THEN rules)</p>
            </div>
            <a href="{{ route('admin.aturan.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg">
                + Tambah Aturan
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
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Nama Aturan</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Penyakit</th>
                        <th class="px-6 py-3 text-left text-sm font-bold text-gray-700">Confidence</th>
                        <th class="px-6 py-3 text-center text-sm font-bold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($aturans as $aturan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $aturan->nama_aturan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $aturan->penyakit->nama_penyakit ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ number_format($aturan->confidence, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <a href="{{ route('admin.aturan.edit', $aturan) }}" class="text-blue-500 hover:text-blue-700 font-medium">Edit</a>
                                <form action="{{ route('admin.aturan.destroy', $aturan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin akan dihapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium ml-4">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                Tidak ada aturan. <a href="{{ route('admin.aturan.create') }}" class="text-blue-500">Buat aturan baru</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $aturans->links() }}
        </div>
    </div>
</div>
@endsection
