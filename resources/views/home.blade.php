<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pakar: Diagnosis Diabetes</title>
    <meta name="description" content="Diagnosis awal Diabetes berbasis sistem pakar gejala" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> 
    
    <link rel="stylesheet" href="{{ asset('landing/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/colors/color.css') }}" />
    <link rel="stylesheet" href="{{ asset('landing/css/owl.carousel.css') }}" />
    
    <style>
        /* ========================================================== */
        /* 1. PALET WARNA & VARIABEL GLOBAL */
        /* ========================================================== */
        :root {
            --color-primary: #007bff;
            --color-accent: #FF5722; 
            --color-success: #10b981; 
            --color-dark: #1f4068;
            --color-soft-bg: #f8f9fa;
        }

        /* ========================================================== */
        /* 2. NAVBAR STYLES */
        /* ========================================================== */
        .navbar-dark-bg {
            background-color: #212121 !important;
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
            transition: color 0.3s ease-in-out;
            text-decoration: none;
        }
        
        .navbar-dark-bg a:hover {
            color: #FF5722 !important;
        }
        
        .navbar-logo-accent {
            color: #10b981;
            font-weight: bold;
        }
        
        /* Mobile Menu Toggle */
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
            
            #navbar-links {
                display: none !important;
            }
            
            #mobile-navbar-links {
                display: none !important;
            }
            
            #mobile-navbar-links.active {
                display: flex !important;
            }
        }

        /* ========================================================== */
        /* 3. HERO SECTION CUSTOM STYLES */
        /* ========================================================== */
        /* Container utama Hero Section */
        .hero-split-container {
            /* Diberi min-height yang jelas */
            min-height: calc(100vh - 64px); /* 64px = tinggi navbar h-16 */
            margin-top: 64px;
        }
        
        /* HEADLINE */
        .hero-headline {
            font-size: 4.5rem; 
            font-weight: 800;
            line-height: 1.1;
        }
        .hero-sub-headline {
            font-size: 1.5rem;
            color: #10b981;
        }

        /* TYPING EFFECT (Target utama Typed.js) */
        #typed-1 {
            color: var(--color-accent); /* Beri warna kontras untuk teks yang bergerak */
            font-weight: 700;
        }

        /* CTA Button */
        .btn-cta {
            background-color: var(--color-success);
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 700;
            color: white !important; /* Memastikan teks putih */
        }
        .btn-cta:hover {
            background-color: #059669;
        }

        /* VISUAL KANAN - PATH GAMBAR DIPERBAIKI */
        .hero-visual-bg {
            /* Gambar dipindahkan ke inline style */
            min-height: calc(100vh - 64px);
            position: relative;
        }
        .hero-overlay {
            background: rgba(0, 0, 0, 0.4);
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            z-index: 1;
        }

        /* ... Gaya lainnya ... */
        .icon-box { box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); min-height: 250px; border-radius: 10px; padding: 30px; background: white; }
        .icon-box:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); }
        .icon-box i { color: #28a745; font-size: 3rem; margin-bottom: 15px; }
        .bg-gradient-info { background: linear-gradient(90deg, #1f4068, #162447); color: #ffffff; }
        @media (max-width: 992px) { 
             .hero-headline { font-size: 10vw; }
             .hero-sub-headline { font-size: 5vw; }
        }
    </style>

</head>

<body>

    <nav class="navbar-dark-bg">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; height: 64px;">
            <!-- Logo -->
            <a href="{{ route('home') }}" style="text-decoration: none; display: flex; align-items: center;">
                <div style="font-size: 20px; font-weight: bold; color: white;">
                    SISTEM <span class="navbar-logo-accent">PAKAR</span>
                </div>
            </a>

            <!-- Mobile Menu Button -->
            <button class="mobile-menu-btn" onclick="toggleMobileMenu()" id="mobile-menu-btn" style="padding: 5px 10px;">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Desktop Navigation Links -->
            <ul id="navbar-links" style="display: flex; gap: 30px; list-style: none; margin: 0; padding: 0;">
                <li style="margin: 0;">
                    <a href="{{ route('home') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                        Home
                    </a>
                </li>
                <li style="margin: 0;">
                    <a href="{{ route('konsultasi.start') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                        Diagnosis
                    </a>
                </li>
                <li style="margin: 0;">
                    <a href="{{ route('informasi.index') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                        Informasi Kesehatan
                    </a>
                </li>
                <li style="margin: 0;">
                    <a href="{{ route('kontak.index') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                        Kontak
                    </a>
                </li>
                @if(auth()->check() && auth()->user()->role === 'admin')
                <li style="margin: 0;">
                    <a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                        Dashboard Admin
                    </a>
                </li>
                <li style="margin: 0;">
                    <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: white; text-decoration: none; padding: 8px 12px; background-color: #FF5722; border-radius: 6px; display: block; transition: background-color 0.3s; font-weight: bold;">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @else
                <li style="margin: 0;">
                    <a href="/login" style="color: white; text-decoration: none; padding: 8px 12px; background-color: #FF5722; border-radius: 6px; display: block; transition: background-color 0.3s; font-weight: bold;">
                        Login Admin
                    </a>
                </li>
                @endif
            </ul>

            <!-- Mobile Navigation Links -->
            <div id="mobile-navbar-links" style="display: none; position: fixed; top: 64px; left: 0; right: 0; background-color: #1a1a1a; flex-direction: column; padding: 20px; gap: 20px; width: 100%; z-index: 99;">
                <a href="{{ route('home') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                    Home
                </a>
                <a href="{{ route('konsultasi.start') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                    Diagnosis
                </a>
                <a href="{{ route('informasi.index') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                    Informasi Kesehatan
                </a>
                <a href="{{ route('kontak.index') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                    Kontak
                </a>
                @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" style="color: white; text-decoration: none; padding: 8px 0; display: block; transition: color 0.3s;">
                    Dashboard Admin
                </a>
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" style="color: white; text-decoration: none; padding: 8px 12px; background-color: #FF5722; border-radius: 6px; display: block; transition: background-color 0.3s; font-weight: bold; text-align: center;">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="/login" style="color: white; text-decoration: none; padding: 8px 12px; background-color: #FF5722; border-radius: 6px; display: block; transition: background-color 0.3s; font-weight: bold; text-align: center;">
                    Login Admin
                </a>
                @endif
            </div>
        </div>
    </nav>

    <main>

        <div class="flex flex-col lg:flex-row hero-split-container">
            
            <div class="w-full lg:w-3/5 flex flex-col justify-center items-center lg:items-start p-8 lg:p-20 bg-gray-50">
                <div class="max-w-xl text-center lg:text-left">
                    
                    <h2 class="hero-sub-headline font-semibold mb-3 uppercase tracking-wider">
                        Sistem Pakar Diagnosa Diabetes
                    </h2>
                    
                    <h1 class="hero-headline text-gray-900 mb-6">
                        Cek Risiko Diabetes Anda,
                        <br><span id="typed-1"></span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 mb-10">
                        Dapatkan estimasi awal tipe Diabetes Anda menggunakan Sistem Pakar berbasis gejala yang akurat.
                    </p>
                    
                    <a href="{{ route('konsultasi.start') }}" class="inline-block text-white btn-cta transition duration-300 transform hover:scale-[1.05]">
                        Mulai Diagnosis Sekarang &nbsp; <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="hidden lg:flex lg:w-2/5 justify-center items-center relative overflow-hidden hero-visual-bg" style="background-image: url('{{ asset('landing/img/full-2.jpg') }}'); background-size: cover; background-position: center;">
                <div class="hero-overlay"></div>
                <div class="relative z-10 p-10">
                    <i class="fas fa-microscope text-white text-9xl opacity-70"></i>
                    <h3 class="mt-4 text-white font-bold text-xl">FORWARD CHAINING ANALYTICS</h3>
                </div>
            </div>

        </div>

        <div id="daftar-gejala" class="section py-16" style="background-color: var(--color-soft-bg);">
            <div class="container mx-auto px-4">
                <div class="row justify-content-center text-center mb-12">
                    <div class="col-md-8">
                        <span class="lead text-muted">GEJALA UTAMA</span>
                        <h2 class="text-3xl">Kenali Tiga Gejala Klasik Diabetes</h2>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-4">
                    <div class="w-full md:w-1/3 px-4 mt-4">
                        <div class="icon-box text-center">
                            <i class="fa-solid fa-mug-hot"></i>
                            <h5 class="mt-3 font-semibold">Cepat Lapar dan Haus (G3)</h5>
                            <p class="text-muted text-sm">Rasa haus berlebihan dan nafsu makan yang terus meningkat (Polifagia dan Polidipsia).</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mt-4">
                        <div class="icon-box text-center">
                            <i class="fa-solid fa-toilet"></i>
                            <h5 class="mt-3 font-semibold">Sering Buang Air Kecil (G1)</h5>
                            <p class="text-muted text-sm">Peningkatan frekuensi berkemih, terutama pada malam hari (Poliuria).</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-4 mt-4">
                        <div class="icon-box text-center">
                            <i class="fa-solid fa-weight-scale"></i>
                            <h5 class="mt-3 font-semibold">Penurunan Berat Badan Tiba-Tiba (G2)</h5>
                            <p class="text-muted text-sm">Berat badan yang menyusut drastis tanpa perubahan pola makan atau aktivitas yang disengaja.</p>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-10">
                    <a href="{{ route('konsultasi.start') }}" class="btn btn-outline-dark" role="button">
                        Lihat Semua Gejala &nbsp; <i class="fa-solid fa-list-check"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="py-16 bg-gradient-info">
            <div class="container mx-auto px-4">
                <div class="row justify-content-center text-center">
                    <div class="col-md-10">
                        <div id="owl-sep-1" class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="quote">
                                    <i class="fa-solid fa-brain" style="font-size: 40px; margin-bottom: 20px; color: #ffc107;"></i>
                                    <p class="lead text-white">"Sistem ini menggunakan logika dan basis pengetahuan layaknya seorang pakar kesehatan untuk mengidentifikasi kemungkinan jenis Diabetes Melitus (Tipe 1, Tipe 2, Gestasional, atau Tipe Lain) berdasarkan gejala yang Anda masukkan."</p>
                                    <h6 style="color: #ccc;">Sistem Berbasis Aturan (Rules)</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section py-16" style="background-color: var(--color-soft-bg);">
            <div class="container mx-auto px-4">
                <div class="row justify-content-center text-center mb-12">
                    <div class="col-md-8">
                        <span class="lead text-muted">PENGEMBANG</span>
                        <h2 class="text-3xl mb-2">Tim Kami</h2>
                        <p>Proyek Akhir Semester Mata Kuliah Kecerdasan Buatan.</p>
                    </div>
                </div>
                <div class="flex flex-wrap justify-center gap-8">
                    <!-- Developer 1 -->
                    <div class="flex flex-col items-center text-center w-full md:w-1/4">
                        <div style="width: 180px; height: 180px; margin-bottom: 15px; border-radius: 50%; overflow: hidden; border: 4px solid #10b981; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                            <img src="landing/img/profil/dwiki.jpeg" alt="Dwiki Nur Ichlas" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h6 class="font-semibold text-lg mt-3">Dwiki Nur Ichlas</h6>
                        <p class="text-muted text-sm">Ketua / Analis Sistem</p>
                    </div>
                    
                    <!-- Developer 2 -->
                    <div class="flex flex-col items-center text-center w-full md:w-1/4">
                        <div style="width: 180px; height: 180px; margin-bottom: 15px; border-radius: 50%; overflow: hidden; border: 4px solid #10b981; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                            <img src="landing/img/profil/artha.jpeg" alt="Putra Artha Nugraha" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h6 class="font-semibold text-lg mt-3">Putra Artha Nugraha</h6>
                        <p class="text-muted text-sm">Web Development</p>
                    </div>
                    
                    <!-- Developer 3 -->
                    <div class="flex flex-col items-center text-center w-full md:w-1/4">
                        <div style="width: 180px; height: 180px; margin-bottom: 15px; border-radius: 50%; overflow: hidden; border: 4px solid #10b981; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                            <img src="landing/img/profil/kris.jpeg" alt="Kris Prediansyah" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h6 class="font-semibold text-lg mt-3">Kris Prediansyah</h6>
                        <p class="text-muted text-sm">Desain & Data Entry</p>
                    </div>
                    
                    <!-- Developer 4 -->
                    <div class="flex flex-col items-center text-center w-full md:w-1/4">
                        <div style="width: 180px; height: 180px; margin-bottom: 15px; border-radius: 50%; overflow: hidden; border: 4px solid #10b981; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);">
                            <img src="landing/img/profil/arya.jpeg" alt="Arya Dwi Putra" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <h6 class="font-semibold text-lg mt-3">Arya Dwi Putra</h6>
                        <p class="text-muted text-sm">Desain & Data Entry</p>
                    </div>
                </div>
            </div>
        </div>

        <section id="faq" class="py-16 bg-light">
            <div class="container mx-auto px-4">
                <div class="row justify-content-center text-center mb-12">
                    <div class="col-md-8">
                        <h2>Pertanyaan yang Sering Diajukan - FAQ</h2>
                    </div>
                </div>
                <div class="accordion mt-5" id="faqAccordion">
                    </div>
            </div>
        </section>


        <div id="kontak" class="section footer py-16" style="background-image: url('{{ asset("landing/img/footer.jpg") }}'); background-size: cover;">
            <div class="container mx-auto px-4">
                <p class="text-center" style="color: #ccc;">© 2025 Sistem Pakar Diabetes. All rights reserved.</p>
            </div>
        </div>

    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script> 
    <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing/js/plugins.js') }}"></script>
    <script src="{{ asset('landing/js/custom.js') }}"></script>
    
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

        // Type text (Typing Effect)
        document.addEventListener('DOMContentLoaded', function() {
            var typed = new Typed('#typed-1', {
                strings: ['Sekarang!', 'Cek Gejala', 'Identifikasi Tipe', 'Langkah Awal Kesehatan'],
                typeSpeed: 45,
                backSpeed: 30, 
                startDelay: 50,
                backDelay: 1500,
                loop: true,
                loopCount: false,
                showCursor: true,
                cursorChar: "|",
            });
        });
    </script>
</body>
</html>