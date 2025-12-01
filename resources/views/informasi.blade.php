<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Kesehatan - Sistem Pakar Diabetes</title>
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
        }
        .navbar-dark-bg a {
            color: #ffffff !important;
            transition: color 0.15s ease-in-out;
        }
        .navbar-dark-bg a:hover {
            color: var(--color-accent) !important;
        }
        .navbar-logo-accent {
            color: var(--color-success);
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            .navbar-links {
                display: none;
            }
            .navbar-links.active {
                display: flex !important;
            }
            #mobile-navbar-links.active {
                display: flex;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('components.navbar')

    <main class="pt-24 pb-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Informasi Kesehatan Diabetes</h1>
                <p class="text-lg text-gray-600">Pelajari lebih lanjut tentang diabetes, gejalanya, dan cara pencegahannya.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Card 1: Pengertian Diabetes -->
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-book text-blue-600 text-3xl mr-4"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Apa itu Diabetes?</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Diabetes Melitus adalah penyakit kronis yang ditandai oleh peningkatan kadar gula (glukosa) dalam darah. 
                        Pankreas tidak dapat memproduksi insulin yang cukup atau tubuh tidak dapat menggunakan insulin dengan efektif.
                    </p>
                </div>

                <!-- Card 2: Tipe-Tipe Diabetes -->
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-sitemap text-green-600 text-3xl mr-4"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Tipe-Tipe Diabetes</h3>
                    </div>
                    <ul class="text-gray-700 space-y-2">
                        <li><strong>Tipe 1:</strong> Pankreas tidak memproduksi insulin</li>
                        <li><strong>Tipe 2:</strong> Tubuh tidak menggunakan insulin dengan efektif</li>
                        <li><strong>Gestasional:</strong> Terjadi saat kehamilan</li>
                        <li><strong>Tipe Lain:</strong> Akibat kondisi atau obat tertentu</li>
                    </ul>
                </div>

                <!-- Card 3: Gejala Umum -->
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-stethoscope text-red-600 text-3xl mr-4"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Gejala Umum</h3>
                    </div>
                    <ul class="text-gray-700 space-y-2">
                        <li>✓ Sering buang air kecil (terutama malam hari)</li>
                        <li>✓ Rasa haus yang berlebihan</li>
                        <li>✓ Nafsu makan meningkat</li>
                        <li>✓ Penurunan berat badan tiba-tiba</li>
                        <li>✓ Kelelahan dan kelemahan</li>
                    </ul>
                </div>

                <!-- Card 4: Faktor Risiko -->
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-3xl mr-4"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Faktor Risiko</h3>
                    </div>
                    <ul class="text-gray-700 space-y-2">
                        <li>• Riwayat keluarga dengan diabetes</li>
                        <li>• Kelebihan berat badan atau obesitas</li>
                        <li>• Gaya hidup sedentari</li>
                        <li>• Usia di atas 45 tahun</li>
                        <li>• Tekanan darah tinggi</li>
                    </ul>
                </div>

                <!-- Card 5: Pencegahan -->
                <div class="bg-white rounded-lg shadow-lg p-8 hover:shadow-xl transition md:col-span-2">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-shield-alt text-green-600 text-3xl mr-4"></i>
                        <h3 class="text-2xl font-bold text-gray-900">Cara Pencegahan</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 p-4 rounded">
                            <h4 class="font-bold text-blue-900 mb-2">🥗 Nutrisi Sehat</h4>
                            <p class="text-sm text-gray-700">Konsumsi makanan bergizi dengan serat tinggi dan kurangi gula.</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded">
                            <h4 class="font-bold text-green-900 mb-2">🏃 Olahraga Teratur</h4>
                            <p class="text-sm text-gray-700">Berolahraga minimal 150 menit per minggu dengan intensitas sedang.</p>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded">
                            <h4 class="font-bold text-yellow-900 mb-2">⚖️ Menjaga Berat Badan</h4>
                            <p class="text-sm text-gray-700">Pertahankan berat badan ideal sesuai dengan IMT normal.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-blue-600 to-green-600 rounded-lg shadow-lg p-8 text-white text-center">
                <h2 class="text-3xl font-bold mb-4">Apakah Anda Berisiko?</h2>
                <p class="text-lg mb-6">Lakukan diagnosis awal dengan sistem pakar kami untuk mengetahui risiko diabetes Anda.</p>
                <a href="{{ route('diagnosis.index') }}" class="inline-block bg-white text-blue-600 font-bold py-3 px-8 rounded-lg hover:bg-gray-100 transition">
                    Mulai Diagnosis Sekarang <i class="fas fa-arrow-right ml-2"></i>
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
        // Mobile Menu Toggle Function
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-navbar-links');
            const mobileBtn = document.getElementById('mobile-menu-btn');
            
            if (mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                mobileBtn.innerHTML = '<i class="fas fa-bars"></i>';
            } else {
                mobileMenu.classList.add('active');
                mobileBtn.innerHTML = '<i class="fas fa-times"></i>';
            }
        }

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobile-navbar-links a').forEach(link => {
            link.addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-navbar-links');
                const mobileBtn = document.getElementById('mobile-menu-btn');
                mobileMenu.classList.remove('active');
                mobileBtn.innerHTML = '<i class="fas fa-bars"></i>';
            });
        });
    </script>
</body>
</html>
