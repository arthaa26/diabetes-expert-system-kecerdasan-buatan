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

            <!-- Name and Age Input Popup (shown on page load) -->
            <div id="nameModalOverlay" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Data Pribadi</h2>
                    <p class="text-gray-600 text-sm mb-6">Silakan masukkan data pribadi Anda untuk diagnosis</p>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="initialNameInput" 
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <p id="nameError" class="text-red-600 text-xs mt-1 hidden">Nama tidak boleh kosong</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Umur (tahun)</label>
                        <input 
                            type="number" 
                            id="initialAgeInput" 
                            placeholder="Masukkan umur Anda"
                            min="0"
                            max="120"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <p id="ageError" class="text-red-600 text-xs mt-1 hidden">Umur harus antara 0-120 tahun</p>
                    </div>

                    <button 
                        type="button"
                        onclick="saveInitialData()"
                        class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition"
                    >
                        Lanjutkan
                    </button>
                </div>
            </div>

            <!-- Header -->

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
                
                <!-- Hidden fields to store the user data entered in popup -->
                <input type="hidden" name="user_name" id="userNameField" value="">
                <input type="hidden" name="user_age" id="userAgeField" value="">

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
        let userNameGlobal = '';
        let userAgeGlobal = '';

        // Show name and age popup on page load
        window.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('nameModalOverlay');
            const nameInput = document.getElementById('initialNameInput');
            
            if (modal) {
                modal.classList.remove('hidden');
            }
            
            if (nameInput) {
                nameInput.focus();
                // Allow Tab to move to age, and Enter on age to submit
                nameInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        document.getElementById('initialAgeInput').focus();
                    }
                });
            }

            const ageInput = document.getElementById('initialAgeInput');
            if (ageInput) {
                ageInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        saveInitialData();
                    }
                });
            }
        });

        function saveInitialData() {
            const nameInput = document.getElementById('initialNameInput');
            const ageInput = document.getElementById('initialAgeInput');
            const nameError = document.getElementById('nameError');
            const ageError = document.getElementById('ageError');
            const modal = document.getElementById('nameModalOverlay');
            
            let isValid = true;

            // Validate name
            if (!nameInput || nameInput.value.trim() === '') {
                if (nameError) nameError.classList.remove('hidden');
                isValid = false;
            } else {
                if (nameError) nameError.classList.add('hidden');
                userNameGlobal = nameInput.value.trim();
            }

            // Validate age
            const ageValue = ageInput ? ageInput.value : '';
            if (ageValue === '' || Number(ageValue) < 0 || Number(ageValue) > 120) {
                if (ageError) ageError.classList.remove('hidden');
                isValid = false;
            } else {
                if (ageError) ageError.classList.add('hidden');
                userAgeGlobal = ageValue;
            }

            if (!isValid) return;

            // Store in hidden fields
            const nameField = document.getElementById('userNameField');
            const ageField = document.getElementById('userAgeField');
            
            if (nameField) nameField.value = userNameGlobal;
            if (ageField) ageField.value = userAgeGlobal;
            
            // Close modal
            if (modal) {
                modal.classList.add('hidden');
            }
        }

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
            
            // Enable diagnose button only if at least one symptom selected
            diagnoseBtn.disabled = checked === 0;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelection);
        });

        // Form submission validation
        document.getElementById('diagnosisForm').addEventListener('submit', function(e) {
            const checked = document.querySelectorAll('.gejala-checkbox:checked').length;
            const nameField = document.getElementById('userNameField');
            const ageField = document.getElementById('userAgeField');

            if (!nameField || nameField.value.trim() === '') {
                e.preventDefault();
                alert('Silakan masukkan nama Anda terlebih dahulu');
                return;
            }

            if (!ageField || ageField.value === '') {
                e.preventDefault();
                alert('Silakan masukkan umur Anda terlebih dahulu');
                return;
            }

            if (checked === 0) {
                e.preventDefault();
                alert('Silakan pilih minimal 1 gejala');
                return;
            }
        });

        function toggleMobileMenu() {
            // Mobile menu logic here
        }
    </script>
</body>
</html>
