# Simulasi Akreditasi Jurnal

Aplikasi evaluasi diri Akreditasi Jurnal Ilmiah berbasis CodeIgniter 4. Aplikasi membantu pengelola jurnal memeriksa kriteria minimum, kelayakan, serta melakukan simulasi penilaian unsur A-G berdasarkan Petunjuk Teknis Akreditasi Jurnal Ilmiah 2026.

Hasil aplikasi merupakan simulasi internal dan bukan keputusan akreditasi resmi.

## Fitur utama

- Registrasi dan login pengelola jurnal.
- Pemisahan data berdasarkan akun dan kepemilikan jurnal.
- Pengelolaan lebih dari satu jurnal dalam satu akun.
- Pemeriksaan Awal sebanyak 15 butir.
- Pemeriksaan Kelayakan sebanyak 2 butir.
- Evaluasi Tata Kelola dan Mutu Artikel unsur A-G.
- Perhitungan skor, progres, dan proyeksi peringkat secara otomatis.
- Dokumentasi kriteria dan rubrik penilaian 2026.

## Persyaratan

- PHP 8.2 atau lebih baru.
- Composer 2.
- MySQL atau MariaDB.
- Ekstensi PHP `intl`, `mbstring`, `mysqli`, `json`, dan `curl`.
- Apache dengan `mod_rewrite` untuk pemasangan melalui XAMPP.

## Instalasi pada XAMPP

1. Clone repositori ke direktori `htdocs`:

   ```powershell
   cd C:\xampp\htdocs
   git clone <URL-REPOSITORI> simulasi-akreditasi-jurnal
   cd simulasi-akreditasi-jurnal
   ```

2. Pasang dependensi:

   ```powershell
   composer install
   ```

3. Salin konfigurasi lingkungan:

   ```powershell
   Copy-Item env .env
   ```

4. Buat database kosong, misalnya `simulasi_akreditasi_jurnal`, kemudian sesuaikan `.env`:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost/simulasi-akreditasi-jurnal/'

   database.default.hostname = localhost
   database.default.database = simulasi_akreditasi_jurnal
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
   database.default.port = 3306
   ```

5. Jalankan migration dan master rubrik:

   ```powershell
   php spark migrate
   php spark db:seed RubricSeeder
   ```

6. Buka `http://localhost/simulasi-akreditasi-jurnal/`, registrasikan akun, lalu tambahkan jurnal pertama.

## Data demo opsional

Seeder akun tidak mempunyai kata sandi bawaan. Jika benar-benar diperlukan untuk pengembangan, isi variabel berikut hanya pada `.env` lokal:

```ini
seed.adminName = 'Admin Jurnal'
seed.adminEmail = 'admin@example.test'
seed.adminPassword = 'gunakan-kata-sandi-kuat'
```

Kemudian jalankan:

```powershell
php spark db:seed UserSeeder
php spark db:seed LeksikonDummySeeder
```

Jangan memasukkan `.env`, dump database, sesi, log, cache, atau unggahan pengguna ke Git.

## Pengujian

```powershell
composer test
```

Peringatan mengenai driver code coverage dapat diabaikan selama seluruh test dan assertion berstatus berhasil.

## Keamanan dan pemisahan data

Setiap akun pengelola hanya dapat mengakses jurnal yang ditugaskan kepadanya. Pembatasan diterapkan pada controller dan query, bukan hanya pada menu.

Untuk penggunaan publik:

- gunakan `CI_ENVIRONMENT = production`;
- gunakan HTTPS;
- gunakan kredensial database khusus dengan hak minimum;
- nonaktifkan directory listing dan jangan mengekspos `.env`;
- lakukan pencadangan database secara berkala;
- jalankan migration dan pengujian sebelum pembaruan aplikasi.

## Struktur ringkas

- `app/Controllers` - alur aplikasi dan otorisasi.
- `app/Database/Migrations` - struktur database.
- `app/Database/Seeds` - master rubrik dan data pengembangan opsional.
- `app/Services` - pembatasan akses dan pemilihan jurnal.
- `app/Views` - antarmuka aplikasi.
- `tests` - pengujian akses dan fungsi dasar.

## Lisensi

Proyek ini menggunakan lisensi MIT. Lihat [LICENSE](LICENSE).
