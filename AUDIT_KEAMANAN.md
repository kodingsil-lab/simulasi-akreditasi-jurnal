# Audit Keamanan dan Isolasi Data

Tanggal pemeriksaan: 11 Agustus 2026  
Lingkup: autentikasi, otorisasi peran, kepemilikan jurnal, evaluasi kriteria, rubrik A–G, disinsentif, dan fungsi operator sistem.

## Model Akses

- `admin_jurnal` hanya dapat membaca dan mengubah jurnal yang ditugaskan kepadanya.
- Setiap jurnal memiliki tepat satu admin penanggung jawab.
- Satu admin boleh mengelola beberapa jurnal, tetapi data setiap jurnal tetap dipisahkan berdasarkan `journal_id` dan `evaluation_id`.
- Operator sistem tidak memiliki route untuk membuka atau mengubah jurnal dan hasil evaluasi pengguna.
- Operator sistem hanya dapat mengaktifkan atau menonaktifkan akses akun pengguna.

## Temuan dan Tindakan

| Risiko | Tingkat | Tindakan |
|---|---|---|
| Manipulasi ID evaluasi untuk membuka jurnal admin lain | Kritis | Seluruh route evaluasi dilindungi filter kepemilikan berbasis `evaluation_id`; controller tetap memeriksa akses sebagai lapisan kedua. |
| Lebih dari satu admin dapat ditugaskan pada jurnal yang sama | Tinggi | Penugasan diubah menjadi satu penanggung jawab dan dibatasi unique constraint pada database. |
| Sesi akun yang sudah dinonaktifkan tetap aktif | Tinggi | Status serta peran akun diverifikasi ulang pada setiap request terautentikasi. |
| Percobaan login tanpa pembatasan | Tinggi | Login dibatasi lima percobaan per kombinasi IP dan email dalam lima menit serta dicatat ke log. |
| CSRF memakai mode cookie pada aplikasi berbasis sesi | Tinggi | CSRF diubah menjadi session-based dan token randomization diaktifkan. |
| Nilai disinsentif dapat dimanipulasi melalui request | Tinggi | Jenis dan nilai disinsentif dibatasi ke pilihan resmi; URL dan panjang catatan divalidasi. |
| Penyimpanan beberapa jawaban dapat berhenti di tengah | Sedang | Penyimpanan checklist, nilai rubrik, jurnal, dan penugasan admin menggunakan transaksi database. |
| URL bukti dan catatan tidak memiliki validasi server memadai | Sedang | URL dibatasi ke HTTP/HTTPS dan panjang input dibatasi. Semua keluaran tetap di-escape pada view. |
| Header keamanan belum aktif | Sedang | Filter `secureheaders` dan pemeriksaan karakter input tidak valid diaktifkan secara global. |
| Operator dapat melihat data simulasi pengguna | Tinggi | Seluruh route jurnal, dokumentasi jurnal, dan monitor evaluasi dihapus dari area operator sistem. |

## Pertahanan yang Sudah Aktif

- Auto-routing nonaktif; hanya route dengan HTTP verb eksplisit yang dapat diakses.
- CSRF aktif secara global untuk operasi perubahan data.
- Password disimpan dengan `password_hash()` dan diperiksa menggunakan `password_verify()`.
- Session ID diregenerasi saat login dan session lama dihancurkan.
- Query Builder digunakan untuk parameter database.
- Seluruh tindakan operator sistem dipisahkan dalam grup route `role:super_admin` dan dibatasi pada pengelolaan status akun.
- Akses objek yang ditolak mengembalikan 404 agar keberadaan jurnal milik admin lain tidak terungkap.

## Catatan untuk Produksi

Sebelum aplikasi dibuka melalui internet:

1. Ubah `CI_ENVIRONMENT` menjadi `production`.
2. Gunakan HTTPS dan aktifkan cookie `secure` serta `forceGlobalSecureRequests`.
3. Jangan menggunakan akun database `root`; buat pengguna database khusus dengan hak minimum.
4. Ganti seluruh akun dan kata sandi dummy.
5. Batasi akses ke `.env`, `writable`, database, log, dan berkas cadangan dari web publik.
6. Siapkan pencadangan database berkala dan uji proses pemulihannya.
7. Pertimbangkan CodeIgniter Shield dan MFA untuk operator sistem sebelum penggunaan publik berskala besar.

## Risiko Tersisa

- Lingkungan saat ini masih `development`, memakai HTTP, dan database lokal menggunakan akun `root` tanpa kata sandi. Kondisi ini hanya dapat diterima untuk XAMPP lokal dan wajib diubah sebelum publikasi.
- Content Security Policy belum diaktifkan karena sejumlah view masih memakai CSS, JavaScript, dan atribut event inline. Aktifkan CSP setelah aset tersebut dipindahkan ke berkas terpisah atau memakai nonce.
- Apache masih dapat mengirim identitas produk pada header `Server`; atur `ServerTokens Prod` pada konfigurasi server produksi.
- Belum ada MFA untuk operator sistem. Untuk penggunaan publik dengan banyak pengelola, MFA atau CodeIgniter Shield sangat disarankan.

## Pengujian Regresi

Pengujian otomatis memastikan:

- admin pertama dapat membuka jurnalnya sendiri;
- admin pertama tidak dapat membuka jurnal atau evaluasi admin kedua;
- ID evaluasi yang tidak ada ditolak;
- operator sistem tidak dapat membuka route jurnal maupun evaluasi pengguna.
