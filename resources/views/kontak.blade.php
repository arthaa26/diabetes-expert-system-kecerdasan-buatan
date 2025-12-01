<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kontak Kami - Sistem Pakar Diabetes</title>
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h1>
                <p class="text-lg text-gray-600">Kami siap membantu Anda. Hubungi kami dengan pertanyaan atau masukan Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Info Kontak -->
                <div>
                    <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                        
                        <div class="mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-blue-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Alamat</h4>
                                    <p class="text-gray-600">Universitas Negeri, Jl. Pendidikan No. 1, Kota, Indonesia</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-phone text-green-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Telepon</h4>
                                    <p class="text-gray-600">+62 (123) 456-7890</p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-red-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Email</h4>
                                    <p class="text-gray-600">info@sistempakar-diabetes.com</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-yellow-600 text-xl mr-4 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900">Jam Operasional</h4>
                                    <p class="text-gray-600">Senin - Jumat: 08:00 - 17:00</p>
                                    <p class="text-gray-600">Sabtu: 09:00 - 13:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Kontak -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>
                    
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('kontak.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                placeholder="Nama Anda">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pesan</label>
                            <textarea name="pesan" rows="5" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                                placeholder="Tulis pesan Anda di sini...">{{ old('pesan') }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                            Kirim Pesan <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map Section (Optional) -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6">Lokasi Kami</h3>
                <div class="w-full h-80 bg-gray-200 rounded-lg flex items-center justify-center">
                    <i class="fas fa-map text-gray-400 text-4xl"></i>
                    <p class="text-gray-500 ml-4">Google Maps Integration (Opsional)</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-gray-300 py-8">
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
