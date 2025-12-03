# Diabetes Expert System — Kecerdasan Buatan

Ringkasan singkat: aplikasi pakar sederhana untuk membantu skrining risiko diabetes menggunakan aturan berbasis gejala. Aplikasi dibuat dengan Laravel dan menyajikan halaman Home setelah aplikasi berjalan.

**Tampilan Home**

- Buka `http://127.0.0.1:8000` atau alamat host lokal Laragon Anda setelah aplikasi dijalankan.
- Halaman Home default ditempatkan di route `/` dan disajikan oleh Blade view (`resources/views/welcome.blade.php` atau `resources/views/home.blade.php`).

**Menjalankan secara lokal (PowerShell / Laragon)**

Jalankan perintah berikut dari direktori proyek (`c:\laragon\www\diabetes-expert-system-kecerdasan-buatan`):

```powershell
# Pasang dependensi PHP
composer install

# Salin file env dan buat APP KEY
copy .env.example .env
php artisan key:generate

# Edit .env untuk konfigurasi database (DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# Jalankan migrasi dan seeder (opsional: --seed jika ingin data contoh)
php artisan migrate --seed

# Jalankan server bawaan Laravel
php artisan serve --host=127.0.0.1 --port=8000

# Buka browser ke:
http://127.0.0.1:8000
```

Jika Anda menggunakan Laragon, Anda kemungkinan memiliki virtual host (mis. `http://diabetes.test`) — sesuaikan `APP_URL` di `.env` dan buka alamat tersebut.

**Jika halaman Home menampilkan halaman Laravel default / tidak muncul**

- Pastikan migrasi dan seeder dijalankan (`php artisan migrate --seed`).
- Periksa route `/` di `routes/web.php` untuk memastikan diarahkan ke view Home yang benar.
- Periksa log di `storage/logs/laravel.log` untuk error runtime.

**Catatan singkat tentang hosting**

- GitHub Pages hanya mendukung konten statis — tidak cocok untuk menjalankan aplikasi Laravel secara penuh.
- Untuk men-deploy aplikasi Laravel dengan backend (PHP), gunakan layanan seperti Render, DigitalOcean App Platform, atau VPS yang mendukung PHP 8.x.
- Jika Anda tetap ingin GitHub Pages untuk preview statis, saya bisa bantu menyalin isi folder `public/` ke `docs/`.

---

Apakah Anda ingin saya:

- menambahkan tangkapan layar Home (saya bisa menambahkan placeholder dan instruksi untuk upload gambar),
- menyiapkan file untuk deploy ke Render (Dockerfile / render.yaml), atau
- mengekspor `public/` ke `docs/` untuk GitHub Pages sekarang?

Balas pilihan Anda dan saya akan lanjutkan.
