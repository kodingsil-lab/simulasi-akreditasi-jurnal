# Rencana Pengerjaan Sistem Evaluasi Diri Akreditasi Jurnal

## Tujuan

Menyediakan aplikasi ringan untuk membantu setiap admin jurnal melakukan evaluasi diri berdasarkan petunjuk teknis akreditasi jurnal. Hasil aplikasi adalah simulasi dan daftar perbaikan, bukan penetapan akreditasi resmi.

## Prinsip Pengembangan

- Satu akun admin jurnal hanya dapat melihat dan mengubah jurnal yang ditugaskan kepadanya.
- Operator sistem hanya mengaktifkan atau menonaktifkan akun pengguna dan tidak dapat membuka data jurnal maupun hasil evaluasi.
- Bukti cukup berupa URL dan catatan. Unggah berkas, pembacaan laman otomatis, dan pengolahan PDF tidak termasuk versi awal.
- Nilai dipilih manual dari pilihan indikator rubrik; sistem hanya menghitung subtotal, total, dan prediksi peringkat secara otomatis.
- Setiap evaluasi disimpan sebagai riwayat agar hasil antarperiode dapat dibandingkan.

## Ruang Lingkup Versi Awal

### Peran Pengguna

| Peran | Hak akses |
|---|---|
| Operator sistem | Mengaktifkan atau menonaktifkan akses akun pengguna untuk kebutuhan teknis. |
| Admin jurnal | Mendaftar mandiri serta mengelola data, bukti, pemeriksaan, dan evaluasi jurnal miliknya. |

### Menu Operator Sistem

1. Dashboard ringkasan akun.
2. Pengelolaan status aktif/nonaktif pengguna.
3. Pengaturan akun operator.

### Menu Admin Jurnal

1. Dashboard jurnal dan status evaluasi terakhir.
2. Profil jurnal.
3. Pemeriksaan awal.
4. Pemeriksaan kelayakan.
5. Evaluasi rubrik.
6. Hasil simulasi dan prioritas perbaikan.
7. Riwayat evaluasi.

## Tahapan Pengerjaan

### Tahap 1 - Fondasi Aplikasi

Tujuan: menyiapkan dasar CodeIgniter 4 dan akses pengguna.

1. Konfigurasi database dan migration.
2. Buat autentikasi login sederhana.
3. Buat peran teknis `super_admin` sebagai operator sistem dan `admin_jurnal` sebagai pengguna aplikasi.
4. Buat filter otorisasi peran dan kepemilikan jurnal.
5. Buat layout dashboard yang ringan dan responsif.

Hasil: pengguna dapat login dan hanya memperoleh menu sesuai perannya.

### Tahap 2 - Jurnal Mandiri dan Isolasi Pemilik

Tujuan: mendukung banyak jurnal dengan pemisahan akses yang aman.

1. Buat data jurnal: nama, e-ISSN, URL, penerbit, fokus/scope, frekuensi, tahun terbit awal, dan DOI.
2. Buat fitur tambah, ubah, dan hapus jurnal milik pengguna sendiri.
3. Kaitkan setiap jurnal kepada akun pembuatnya melalui tabel kepemilikan.
4. Terapkan pembatasan data di query dan controller, bukan hanya dengan menyembunyikan menu.

Hasil: setiap pengguna hanya dapat melihat dan mengelola jurnal miliknya sendiri.

### Tahap 3 - Siklus Evaluasi dan Pemeriksaan Awal

Tujuan: memastikan syarat dasar dapat diperiksa sebelum mengisi skor rubrik.

1. Admin jurnal membuat evaluasi berdasarkan periode/tahun.
2. Sediakan status tiap butir: `sesuai`, `belum sesuai`, atau `perlu verifikasi`.
3. Sediakan kolom URL bukti dan catatan untuk tiap butir.
4. Masukkan butir pemeriksaan awal: identitas/ISSN/penerbit, kesesuaian usulan, frekuensi dan keberkalaan, kelengkapan laman, keragaman afiliasi, serta kredensial akses.
5. Tambahkan pemeriksaan kelayakan untuk peer review serta validitas dan integritas penerbit.
6. Tampilkan status lulus/belum lulus sebagai indikator kesiapan, bukan keputusan resmi.

Hasil: admin memiliki checklist bukti yang jelas sebelum melakukan evaluasi nilai.

### Tahap 4 - Master Rubrik dan Perhitungan Nilai

Tujuan: mengimplementasikan simulasi sesuai struktur rubrik aturan.

1. Siapkan master rubrik dengan versi aturan agar dapat diperbarui tanpa mengubah riwayat.
2. Masukkan tujuh unsur dan bobotnya:

| Kode | Unsur | Bobot |
|---|---|---:|
| A | Konsistensi identitas jurnal | 2 |
| B | Tata kelola jurnal dan keberagaman mitra bestari/editor/pemimpin | 22 |
| C | Kelengkapan laman jurnal | 7 |
| D | Keberkalaan penerbitan jurnal ilmiah | 3 |
| E | Penyebarluasan jurnal ilmiah | 12 |
| F | Mutu artikel (substansi) | 34 |
| G | Gaya penulisan dan penyuntingan artikel | 20 |
|  | Total | 100 |

3. Buat form penilaian per subunsur: pilihan indikator/nilai, alasan, URL bukti, dan catatan tindak lanjut.
4. Hitung subtotal tata kelola (maksimum 46), mutu artikel (maksimum 54), serta total secara otomatis.
5. Tampilkan proyeksi tingkat: 90-100, 80-<90, 70-<80, 60-<70, atau <60.
6. Catat disinsentif integritas secara terpisah dan tampilkan dengan jelas bila diterapkan.

Hasil: admin dapat menilai diri dengan kalkulasi yang konsisten dan dapat ditelusuri.

### Tahap 5 - Dashboard dan Rencana Perbaikan

Tujuan: menjadikan hasil evaluasi mudah ditindaklanjuti.

1. Dashboard admin jurnal menampilkan progres checklist, skor sementara, dan indikator yang belum diisi.
2. Hasil evaluasi menampilkan total skor, prediksi tingkat, dan disclaimer simulasi evaluasi diri.
3. Buat daftar prioritas perbaikan dari butir belum sesuai, bernilai nol/rendah, dan berbobot besar.
4. Seluruh ringkasan dan rencana perbaikan hanya tersedia kepada pemilik jurnal.

Hasil: pengelola memperoleh arah perbaikan tanpa pemantauan isi simulasi oleh operator sistem.

### Tahap 6 - Pengujian dan Penyempurnaan

Tujuan: memastikan akses dan perhitungan benar sebelum digunakan.

1. Uji pembatasan akses antaradmin jurnal.
2. Uji operator sistem tidak dapat membuka jurnal, jawaban, bukti, maupun skor evaluasi pengguna.
3. Uji seluruh rumus subtotal, total, dan prediksi tingkat.
4. Uji alur jurnal baru hingga evaluasi selesai.
5. Uji pada ponsel dan layar desktop.

Hasil: aplikasi siap dipakai secara internal.

## Struktur Data Minimal

| Tabel | Fungsi |
|---|---|
| `users` | Akun dan peran pengguna. |
| `journals` | Profil jurnal. |
| `journal_admins` | Penugasan admin jurnal ke jurnal. |
| `evaluations` | Satu siklus evaluasi untuk satu jurnal dan periode tertentu. |
| `eligibility_items` | Master butir pemeriksaan awal dan kelayakan. |
| `eligibility_answers` | Status, URL bukti, dan catatan tiap butir pada evaluasi. |
| `rubric_versions` | Versi aturan/rubrik yang dipakai. |
| `rubric_items` | Master unsur, subunsur, indikator, dan opsi nilai. |
| `rubric_scores` | Nilai, alasan, dan bukti setiap subunsur dalam evaluasi. |

## Fitur yang Ditunda

Fitur berikut tidak dibuat pada versi awal agar aplikasi tetap ringan dan fokus:

- Crawling atau validasi otomatis terhadap situs jurnal.
- Upload dan penyimpanan berkas bukti.
- OCR atau pembacaan PDF artikel otomatis.
- Penilaian berbasis AI.
- Notifikasi email/WhatsApp.
- Ekspor PDF dan laporan kompleks.
- Kolaborasi banyak penilai pada satu evaluasi.

Fitur tersebut dapat ditambahkan setelah alur evaluasi manual stabil dan kebutuhan pengguna nyata sudah terukur.

## Tahap 7 - Instrumen Evaluasi Diri A-G

Tujuan: menyediakan pengalaman evaluasi diri yang mudah dipahami, seperti instrumen pada contoh, agar pengelola jurnal memilih skor berdasarkan indikator rubrik yang jelas.

1. Buat halaman instrumen evaluasi diri untuk satu jurnal dan satu periode evaluasi.
2. Tampilkan navigasi unsur A-G di sisi kiri, dengan progres pengisian pada setiap unsur.
3. Kelompokkan subunsur secara bertahap, misalnya B.1 sampai B.5 dan F.1 sampai F.9, agar form tidak terlalu panjang.
4. Tampilkan satu subunsur aktif pada panel utama beserta nama, bobot maksimum, dan petunjuk penilaian.
5. Tampilkan setiap opsi sebagai pilihan yang jelas, misalnya `Skor 2`, `Skor 1`, atau `Skor 0`, disertai uraian indikator lengkap dari rubrik 2026.
6. Setelah admin memilih skor, tampilkan kolom alasan evaluasi diri, URL bukti, catatan, dan rencana tindak lanjut.
7. Sediakan tombol Sebelumnya, Simpan dan Lanjutkan, serta Selesai Evaluasi.
8. Tampilkan ringkasan nilai sementara unsur aktif dan total sementara tanpa menghilangkan data yang belum disimpan.

Hasil: pengelola jurnal dapat menilai satu per satu subunsur A-G dengan pilihan skor yang dapat dipertanggungjawabkan.

## Tahap 8 - Rekapitulasi Nilai dan Simulasi Peringkat SINTA

Tujuan: mengubah skor evaluasi diri menjadi hasil simulasi yang mudah dibaca dan ditindaklanjuti.

1. Hitung akumulasi nilai per unsur A, B, C, D, E, F, dan G.
2. Tampilkan subtotal Tata Kelola (A-E, maksimum 46) dan Mutu Artikel (F-G, maksimum 54).
3. Tampilkan nilai sebelum disinsentif, nilai disinsentif integritas bila ada, dan nilai akhir 0-100.
4. Tentukan simulasi hasil berdasarkan nilai akhir:

| Nilai akhir | Simulasi hasil |
|---:|---|
| 90-100 | Terakreditasi Peringkat 1 / SINTA 1 |
| 80-<90 | Terakreditasi Peringkat 2 / SINTA 2 |
| 70-<80 | Terakreditasi Peringkat 3 / SINTA 3 |
| 60-<70 | Terakreditasi Peringkat 4 / SINTA 4 |
| <60 | Belum terakreditasi |

5. Cantumkan disclaimer bahwa hasil adalah simulasi evaluasi diri dan penetapan resmi berada pada kewenangan Direktorat Jenderal.
6. Sediakan ringkasan visual sederhana: total skor, proyeksi peringkat, progres pengisian, dan unsur dengan nilai terendah.

Hasil: pengelola jurnal memahami posisi kesiapan akreditasinya dan proyeksi peringkat dari simulasi.

## Tahap 9 - Rekomendasi Perbaikan dan Laporan

Tujuan: mengubah hasil evaluasi menjadi rencana kerja peningkatan jurnal.

1. Urutkan prioritas dari syarat minimum yang belum sesuai, skor nol/rendah, dan subunsur berbobot besar.
2. Tampilkan alasan, bukti yang sudah tersedia, dan rencana tindak lanjut dari setiap prioritas.
3. Kelompokkan rekomendasi menjadi: wajib sebelum pengajuan, prioritas tinggi, dan penguatan mutu.
4. Sediakan halaman ringkasan yang dapat dicetak sebagai laporan evaluasi diri internal.
5. Simpan riwayat hasil setiap periode agar kemajuan jurnal dapat dibandingkan.

Hasil: evaluasi diri menghasilkan daftar pekerjaan yang konkret, bukan hanya angka simulasi.
