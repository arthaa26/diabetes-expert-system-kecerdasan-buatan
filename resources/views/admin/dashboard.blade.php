@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Sidebar -->
    <aside class="lg:col-span-1 bg-white rounded-lg shadow p-4">
        <h3 class="text-lg font-semibold mb-4">Menu Admin</h3>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'font-bold bg-gray-50' : '' }}">Dashboard</a>
            <a href="{{ route('admin.gejala.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Manajemen Gejala</a>
            <a href="{{ route('admin.penyakit.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Manajemen Penyakit</a>
            <a href="{{ route('admin.aturan.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Manajemen Aturan</a>
        </nav>
    </aside>

    <!-- Main -->
    <div class="lg:col-span-3 space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold">Selamat datang, {{ auth()->user()->name ?? 'Admin' }}</h1>
            <p class="text-sm text-gray-600">Ringkasan sistem pakar diabetes</p>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-sm text-gray-500">Total Gejala</div>
                <div class="text-3xl font-bold text-blue-600">{{ $gejalaCount ?? 0 }}</div>
                <a href="{{ route('admin.gejala.index') }}" class="text-sm text-blue-600 mt-3 inline-block">Kelola Gejala →</a>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-sm text-gray-500">Total Penyakit</div>
                <div class="text-3xl font-bold text-green-600">{{ $penyakitCount ?? 0 }}</div>
                <a href="{{ route('admin.penyakit.index') }}" class="text-sm text-green-600 mt-3 inline-block">Kelola Penyakit →</a>
            </div>
            <div class="bg-white rounded-lg shadow p-5">
                <div class="text-sm text-gray-500">Total Aturan</div>
                <div class="text-3xl font-bold text-yellow-600">{{ $aturanCount ?? 0 }}</div>
                <a href="{{ route('admin.aturan.index') }}" class="text-sm text-yellow-600 mt-3 inline-block">Kelola Aturan →</a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-3">Aksi Cepat</h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.gejala.create') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded">Tambah Gejala</a>
                <a href="{{ route('admin.penyakit.create') }}" class="inline-block bg-green-600 text-white py-2 px-4 rounded">Tambah Penyakit</a>
                <a href="{{ route('admin.aturan.create') }}" class="inline-block bg-orange-600 text-white py-2 px-4 rounded">Tambah Aturan</a>
            </div>
        </div>

        <!-- Recent activity / placeholder -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-semibold mb-4">Aktivitas Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b">
                        <tr>
                            <th class="py-3 px-4 text-sm text-gray-600">User</th>
                            <th class="py-3 px-4 text-sm text-gray-600">Umur</th>
                            <th class="py-3 px-4 text-sm text-gray-600">Diagnosis</th>
                            <th class="py-3 px-4 text-sm text-gray-600">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $activity)
                            <tr class="border-b">
                                <td class="py-3 px-4">{{ $activity->user_name ?? 'Guest' }}</td>
                                <td class="py-3 px-4">{{ $activity->user_age ?? '-' }}</td>
                                <td class="py-3 px-4">{{ $activity->result_summary ?? '-' }}</td>
                                <td class="py-3 px-4">{{ optional($activity->created_at)->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada aktivitas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
