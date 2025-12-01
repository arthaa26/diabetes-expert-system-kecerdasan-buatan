<nav class="navbar-dark-bg fixed w-full z-20 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center">
            <div class="text-xl font-extrabold text-white">SISTEM <span class="navbar-logo-accent">PAKAR</span></div>
        </a>

        <!-- Mobile Menu Button -->
        <button class="mobile-menu-btn" onclick="toggleMobileMenu()" id="mobile-menu-btn">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Desktop Navigation Links -->
        <ul class="hidden md:flex space-x-8 text-sm font-medium navbar-links" id="navbar-links">
            <li>
                <a href="{{ route('home') }}" class="py-2 hover:text-orange-500 transition">
                    Home
                </a>
            </li>
            <li>
                <a href="{{ route('konsultasi.start') }}" class="py-2 hover:text-orange-500 transition">
                    Diagnosis
                </a>
            </li>
            <li>
                <a href="{{ route('informasi.index') }}" class="py-2 hover:text-orange-500 transition">
                    Informasi Kesehatan
                </a>
            </li>
            <li>
                <a href="{{ route('kontak.index') }}" class="py-2 hover:text-orange-500 transition">
                    Kontak
                </a>
            </li>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="py-2 hover:text-orange-500 transition">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="/login" class="py-2 px-4 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-bold">
                    Login Admin
                </a>
            </li>
        </ul>

        <!-- Mobile Navigation Links -->
        <div class="md:hidden fixed top-16 left-0 right-0 bg-gray-900 navbar-links" id="mobile-navbar-links">
            <ul class="flex flex-col p-4 space-y-4">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 text-white hover:text-orange-500 transition">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('konsultasi.start') }}" class="block py-2 text-white hover:text-orange-500 transition">
                        Diagnosis
                    </a>
                </li>
                <li>
                    <a href="{{ route('informasi.index') }}" class="block py-2 text-white hover:text-orange-500 transition">
                        Informasi Kesehatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('kontak.index') }}" class="block py-2 text-white hover:text-orange-500 transition">
                        Kontak
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 text-white hover:text-orange-500 transition">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/login" class="block py-2 px-4 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition font-bold text-center">
                        Login Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
