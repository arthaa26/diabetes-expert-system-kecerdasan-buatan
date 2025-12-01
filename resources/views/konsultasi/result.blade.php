<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosis - Sistem Pakar Diabetes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        :root {
            --color-primary: #007bff;
            --color-accent: #FF5722;
            --color-success: #10b981;
            --color-dark: #1f2937;
        }
        
        .navbar-dark-bg {
            background-color: #212121;
            color: #ffffff;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            height: 64px;
        }
        .navbar-dark-bg a {
            color: #ffffff !important;
            transition: color 0.15s ease-in-out;
            text-decoration: none;
        }
        .navbar-dark-bg a:hover {
            color: #FF5722 !important;
        }
        .navbar-logo-accent {
            color: #10b981;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 5px 10px;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block !important;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="navbar-dark-bg">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; height: 64px;">
            <a href="{{ route('home') }}" style="text-decoration: none; display: flex; align-items: center;">
                <div style="font-size: 20px; font-weight: bold; color: white;">
                    SISTEM <span class="navbar-logo-accent">PAKAR</span>
                </div>
            </a>
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()" id="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <ul id="navbar-links" style="display: flex; gap: 30px; list-style: none; margin: 0; padding: 0;">
                <li style="margin: 0;">
                    <a href="{{ route('home') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block;">Home</a>
                </li>
                <li style="margin: 0;">
                    <a href="{{ route('konsultasi.start') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block;">Diagnosis</a>
                </li>
                <li style="margin: 0;">
                    <a href="{{ route('informasi.index') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block;">Informasi</a>
                </li>
            </ul>
        </div>
    </nav>

    <main class="pt-24 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Hasil Diagnosis Anda</h1>
                <p class="text-lg text-gray-600">Berikut adalah hasil analisis berdasarkan gejala yang Anda pilih</p>
            </div>

            <!-- Diagnosis Results -->
            @if(count($diagnosis) > 0)
                <div class="space-y-6 mb-12">
                    @foreach($diagnosis as $result)
                        @php
                            $confidence = $result['confidence'];
                            $colorClass = 'bg-green-50 border-green-500';
                            if ($confidence < 50) {
                                $colorClass = 'bg-blue-50 border-blue-500';
                            } elseif ($confidence < 70) {
                                $colorClass = 'bg-yellow-50 border-yellow-500';
                            } elseif ($confidence < 85) {
                                $colorClass = 'bg-orange-50 border-orange-500';
                            }
                        @endphp

                        <div class="border-l-4 {{ $colorClass }} p-6 rounded-lg shadow-md">
                            <!-- Disease Name & Confidence -->
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $result['penyakit']->nama_penyakit }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $result['penyakit']->kode_penyakit }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-4xl font-bold text-blue-600">{{ number_format($confidence, 1) }}%</div>
                                    <p class="text-sm text-gray-600">Confidence Level</p>
                                </div>
                            </div>

                            <!-- Confidence Progress Bar -->
                            <div class="mb-4">
                                <div class="w-full bg-gray-300 rounded-full h-4" style="height: 1rem;">
                                    <div class="bg-blue-600 rounded-full" data-width="{{ intval($confidence) }}" style="height: 1rem; transition: all 0.3s ease;"></div>
                                </div>
                            </div>
                            <script>
                                document.querySelectorAll('[data-width]').forEach(function(el) {
                                    el.style.width = el.getAttribute('data-width') + '%';
                                });
                            </script>

                            <!-- Description -->
                            <p class="text-gray-700 mb-4 leading-relaxed">{{ $result['penyakit']->deskripsi }}</p>

                            <!-- Recommendations -->
                            <div class="bg-white rounded-lg p-4 mb-4">
                                <h4 class="font-bold text-gray-900 mb-3"><i class="fas fa-check-circle text-green-600 mr-2"></i>Rekomendasi Penanganan</h4>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $result['penyakit']->penanganan }}</p>
                            </div>

                            <!-- Matched Rules -->
                            @if(isset($result['aturans']))
                                <div class="bg-white rounded-lg p-4">
                                    <h4 class="font-bold text-gray-900 mb-3"><i class="fas fa-list mr-2"></i>Aturan yang Cocok ({{ count($result['aturans']) }})</h4>
                                    <ul class="space-y-2">
                                        @foreach($result['aturans'] as $aturan)
                                            <li class="text-sm text-gray-600 flex items-start">
                                                <i class="fas fa-angle-right text-blue-600 mr-2 mt-1"></i>
                                                {{ $aturan }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-blue-50 border border-blue-300 rounded-lg p-6 text-center mb-8">
                    <i class="fas fa-info-circle text-blue-600 text-4xl mb-3"></i>
                    <h3 class="text-xl font-bold text-blue-900 mb-2">Tidak Ada Kecocokan Sempurna</h3>
                    <p class="text-blue-700">Gejala yang Anda pilih tidak cocok dengan pola diagnosis apa pun. Silakan berkonsultasi dengan dokter untuk pemeriksaan lebih lanjut.</p>
                </div>
            @endif

            <!-- Important Notice -->
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-8">
                <h4 class="font-bold text-red-900 mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Perhatian Penting</h4>
                <ul class="text-red-800 text-sm space-y-2">
                    <li>• Hasil diagnosis ini hanya bersifat <strong>estimasi awal</strong> dan BUKAN pengganti konsultasi medis profesional</li>
                    <li>• Untuk diagnosis yang akurat, silakan berkonsultasi dengan dokter atau tenaga kesehatan yang berpengalaman</li>
                    <li>• Lakukan pemeriksaan laboratorium (tes darah) untuk konfirmasi diagnosis</li>
                    <li>• Jangan menunda pemeriksaan medis jika Anda mengalami gejala diabetes</li>
                </ul>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('konsultasi.start') }}" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 transition text-center">
                    <i class="fas fa-redo mr-2"></i> Diagnosis Ulang
                </a>
                <a href="{{ route('home') }}" class="inline-block bg-gray-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-700 transition text-center">
                    <i class="fas fa-home mr-2"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-300 py-8 mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>© 2025 Sistem Pakar Diabetes. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            // Mobile menu logic here
        }
    </script>
</body>
</html>
