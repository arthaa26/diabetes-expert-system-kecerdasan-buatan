<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Diagnosis Diabetes - Sistem Pakar</title>
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

        .checkbox-card {
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .checkbox-card input[type="checkbox"] {
            position: absolute;
            opacity: 0;
        }

        .checkbox-card input[type="checkbox"]:checked + label {
            background-color: #e0f2fe;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
        }

        .checkbox-card label {
            display: block;
            padding: 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-card label:hover {
            border-color: #0284c7;
            background-color: #f0f9ff;
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
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Diagnosis Diabetes</h1>
                <p class="text-lg text-gray-600">Silakan pilih gejala yang Anda alami untuk memulai diagnosis</p>
            </div>

            <!-- Instructions -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                <h3 class="font-bold text-blue-900 mb-2"><i class="fas fa-info-circle mr-2"></i>Petunjuk Penggunaan</h3>
                <ul class="text-blue-800 text-sm space-y-1">
                    <li>✓ Pilih <strong>minimal 1 gejala</strong> yang Anda alami</li>
                    <li>✓ Anda dapat memilih lebih dari satu gejala untuk hasil yang lebih akurat</li>
                    <li>✓ Tekan tombol "Diagnosa" untuk melihat hasil diagnosis</li>
                    <li>✓ Hasil diagnosis hanya bersifat estimasi - segera konsultasi ke dokter</li>
                </ul>
            </div>

            <!-- Symptoms Form -->
            <form action="{{ route('konsultasi.diagnose') }}" method="POST" id="diagnosisForm">
                @csrf

                <!-- Symptoms Grid -->
                <div class="space-y-6 mb-8">
                    @forelse($gejalas as $gejala)
                        @if($loop->first)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @endif

                            <div class="checkbox-card">
                                <input 
                                    type="checkbox" 
                                    id="gejala_{{ $gejala->id }}" 
                                    name="gejala_ids[]" 
                                    value="{{ $gejala->id }}"
                                    class="gejala-checkbox"
                                >
                                <label for="gejala_{{ $gejala->id }}">
                                    <div class="font-bold text-gray-900 mb-1">
                                        <i class="fas fa-check-circle mr-2 text-blue-600"></i>{{ $gejala->nama_gejala }}
                                    </div>
                                    <div class="text-sm text-gray-600 ml-6">
                                        {{ $gejala->kode_gejala }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-2 ml-6">
                                        {{ Str::limit($gejala->deskripsi, 80) }}
                                    </div>
                                </label>
                            </div>

                        @if($loop->last)
                        </div>
                        @endif
                    @empty
                        <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-6 text-center">
                            <p class="text-yellow-800">Tidak ada data gejala tersedia</p>
                        </div>
                    @endforelse
                </div>

                <!-- Error Messages -->
                @if($errors->has('gejala_ids'))
                    <div class="bg-red-50 border border-red-300 rounded-lg p-4 mb-8">
                        <p class="text-red-800 font-semibold"><i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('gejala_ids') }}</p>
                    </div>
                @endif

                <!-- Selected Count -->
                <div class="bg-white rounded-lg p-4 mb-8 border border-gray-200">
                    <p class="text-gray-700">
                        <strong>Gejala yang dipilih:</strong> 
                        <span id="selectedCount" class="text-blue-600 font-bold">0</span> / {{ $gejalas->count() }}
                    </p>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div id="selectionBar" class="bg-blue-600 h-2 rounded-full transition-all" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                    <button 
                        type="submit" 
                        id="diagnoseBtn"
                        class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 transition text-center disabled:bg-gray-400 disabled:cursor-not-allowed"
                        disabled
                    >
                        <i class="fas fa-stethoscope mr-2"></i> Diagnosa
                    </button>
                    <a href="{{ route('home') }}" class="inline-block bg-gray-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-gray-700 transition text-center">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>

                <!-- Help Text -->
                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-lg">
                    <h4 class="font-bold text-green-900 mb-2"><i class="fas fa-lightbulb mr-2"></i>Tips Akurasi Diagnosis</h4>
                    <ul class="text-green-800 text-sm space-y-1">
                        <li>• Pilih gejala yang Anda alami dengan jujur dan akurat</li>
                        <li>• Lebih banyak gejala yang dipilih = hasil diagnosis lebih akurat</li>
                        <li>• Hasil terbaik diperoleh ketika memilih 5-10 gejala yang relevan</li>
                        <li>• Jika tidak yakin, sebaiknya konsultasikan dengan dokter terlebih dahulu</li>
                    </ul>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-300 py-8 mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p>© 2025 Sistem Pakar Diabetes. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const checkboxes = document.querySelectorAll('.gejala-checkbox');
        const selectedCount = document.getElementById('selectedCount');
        const selectionBar = document.getElementById('selectionBar');
        const diagnoseBtn = document.getElementById('diagnoseBtn');
        const totalGejalas = checkboxes.length;

        function updateSelection() {
            const checked = document.querySelectorAll('.gejala-checkbox:checked').length;
            selectedCount.textContent = checked;
            
            const percentage = (checked / totalGejalas) * 100;
            selectionBar.style.width = percentage + '%';
            
            diagnoseBtn.disabled = checked === 0;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelection);
        });

        // Form submission validation
        document.getElementById('diagnosisForm').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.gejala-checkbox:checked').length;
            if (checked === 0) {
                e.preventDefault();
                alert('Silakan pilih minimal 1 gejala');
            }
        });

        function toggleMobileMenu() {
            // Mobile menu logic here
        }
    </script>
</body>
</html>
