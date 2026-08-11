<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Rubric2026 extends BaseConfig
{
    public string $name = 'Rubrik Akreditasi Jurnal Ilmiah 2026';
    public string $reference = 'Keputusan Direktur Jenderal Sains dan Teknologi Nomor 374/DST/D.D1/HM.01.01/2026';

    public array $categories = [
        'A' => ['label' => 'Konsistensi Identitas Jurnal', 'max' => 2, 'group' => 'Tata Kelola'],
        'B' => ['label' => 'Tata Kelola Jurnal Ilmiah dan Keberagaman Mitra Bestari/Editor/Penulis', 'max' => 22, 'group' => 'Tata Kelola'],
        'C' => ['label' => 'Kelengkapan Laman Jurnal Ilmiah', 'max' => 7, 'group' => 'Tata Kelola'],
        'D' => ['label' => 'Keberkalaan Penerbitan Jurnal Ilmiah', 'max' => 3, 'group' => 'Tata Kelola'],
        'E' => ['label' => 'Penyebarluasan Jurnal Ilmiah', 'max' => 12, 'group' => 'Tata Kelola'],
        'F' => ['label' => 'Mutu Artikel (Substansi)', 'max' => 34, 'group' => 'Mutu Artikel'],
        'G' => ['label' => 'Gaya Penulisan dan Penyuntingan Artikel', 'max' => 20, 'group' => 'Mutu Artikel'],
    ];

    public array $items = [
        'A' => ['label' => 'Konsistensi Identitas Jurnal', 'max' => 2, 'options' => [
            [2, 'Nama jurnal unik dan/atau spesifik sehingga mencerminkan super-spesialisasi atau spesialisasi disiplin ilmu tertentu serta konsisten pada laman jurnal, metadata artikel, dan judul sirahan galley PDF.'],
            [1, 'Nama jurnal kurang unik dan/atau kurang spesifik, berkaitan dengan bidang ilmu yang meluas, dan kurang konsisten pada laman jurnal, metadata artikel, dan judul sirahan galley PDF.'],
            [0, 'Nama jurnal tidak unik, serupa dengan jurnal lainnya, dan/atau mengandung nama lembaga/institusi lokal, dan/atau tidak sesuai dengan yang terdaftar di ISSN.'],
        ]],
        'B.1' => ['label' => 'Komposisi, Rekam Jejak Publikasi, dan Keberagaman Asal Mitra Bestari/Peer-Reviewer', 'max' => 6, 'options' => [
            [6, 'Reviewer aktif mempunyai rekam jejak publikasi internasional 3 tahun terakhir, berasal dari 5 negara atau lebih, setiap naskah ditelaah minimal 3 orang, dan disertai bukti telaah.'],
            [4, 'Reviewer aktif mempunyai rekam jejak publikasi internasional 3 tahun terakhir, berasal dari minimal 6 institusi dari 3 negara atau 8 institusi, setiap naskah ditelaah minimal 2 orang, dan disertai bukti telaah.'],
            [2, 'Reviewer aktif mempunyai rekam jejak publikasi minimal nasional 3 tahun terakhir, berasal dari minimal 6 institusi, setiap naskah ditelaah minimal 2 orang, dan disertai bukti telaah.'],
            [1, 'Reviewer aktif mempunyai rekam jejak publikasi minimal nasional 3 tahun terakhir, berasal dari minimal 4 institusi, setiap naskah ditelaah minimal 2 orang, dan disertai bukti telaah.'],
            [0, 'Tidak melibatkan reviewer secara aktif dan/atau tidak dapat menunjukkan bukti telaah substantif.'],
        ]],
        'B.2' => ['label' => 'Mutu Penyuntingan Substansi oleh Mitra Bestari/Peer-Reviewer', 'max' => 4, 'options' => [
            [4, 'Mutu penyuntingan sangat baik; reviewer memberikan catatan dan saran substantif serta signifikan sehingga mutu isi artikel terjaga selama 3 tahun terakhir.'],
            [2, 'Mutu penyuntingan kurang baik; reviewer kurang memberikan catatan substantif dan tidak signifikan.'],
            [0, 'Reviewer hanya memberikan catatan terkait tata bahasa dan tata letak.'],
        ]],
        'B.3' => ['label' => 'Pelibatan, Komposisi, Rekam Jejak Publikasi, dan Keberagaman Asal Tim Editor', 'max' => 5, 'options' => [
            [5, 'Tim Editor aktif, mempunyai rekam jejak publikasi internasional 3 tahun terakhir, berasal dari 5 negara atau lebih, dan disertai bukti aktivitas.'],
            [3, 'Tim Editor aktif, mempunyai rekam jejak publikasi internasional 3 tahun terakhir, berasal dari minimal 2 negara atau 6 institusi, dan disertai bukti aktivitas.'],
            [2, 'Tim Editor aktif, mempunyai rekam jejak publikasi nasional 3 tahun terakhir, berasal dari minimal 4 institusi, dan disertai bukti aktivitas.'],
            [1, 'Tim Editor aktif, mempunyai rekam jejak publikasi nasional 3 tahun terakhir, berasal dari 2 institusi, dan disertai bukti aktivitas.'],
        ]],
        'B.4' => ['label' => 'Keberagaman Asal Penulis', 'max' => 6, 'options' => [
            [6, 'Penulis berasal dari 5 negara atau lebih per nomor terbitan selama 3 tahun terakhir.'],
            [4, 'Penulis berasal minimal dari 2 negara atau 8 institusi per nomor terbitan selama 3 tahun terakhir.'],
            [2, 'Penulis berasal minimal dari 4 institusi per nomor terbitan selama 3 tahun terakhir.'],
            [1, 'Penulis berasal minimal dari 2 institusi per nomor terbitan selama 3 tahun terakhir.'],
            [0, 'Penulis hanya berasal dari 1 institusi per nomor terbitan selama 3 tahun terakhir.'],
        ]],
        'B.5' => ['label' => 'Pengelolaan Artikel Jurnal Ilmiah', 'max' => 1, 'options' => [
            [1, 'Menggunakan pengelolaan penyuntingan artikel melalui sistem manajemen jurnal daring.'],
            [0.5, 'Menggunakan kombinasi sistem manajemen jurnal daring dan surat elektronik.'],
            [0, 'Menggunakan surat elektronik saja.'],
        ]],
        'C.1' => ['label' => 'Kejelasan Kebijakan Proses Penelaahan', 'max' => 2, 'options' => [
            [2, 'Kebijakan proses penelaahan menjelaskan secara jelas seluruh proses peer-review naskah.'],
            [1, 'Kebijakan menjelaskan secara jelas sebagian proses peer-review.'],
            [0, 'Kebijakan tidak tersedia atau tidak menjelaskan prinsip dasar proses peer-review.'],
        ]],
        'C.2' => ['label' => 'Kejelasan Petunjuk Penulisan bagi Penulis', 'max' => 1, 'options' => [
            [1, 'Petunjuk penulisan terinci, lengkap, substantif, sistematis, tersedia di laman dan template artikel, serta tersedia contoh template.'],
            [0.5, 'Petunjuk penulisan lengkap di laman tetapi tidak tersedia contoh template.'],
            [0, 'Petunjuk kurang lengkap/tidak jelas atau hanya tersedia template tanpa petunjuk.'],
        ]],
        'C.3' => ['label' => 'Kebijakan Penggunaan Kecerdasan Artifisial', 'max' => 1, 'options' => [
            [1, 'Memiliki kebijakan AI yang mengatur kewajiban pengungkapan penggunaan AI oleh Penulis, batas penggunaan oleh Editor, dan larangan penggunaan AI oleh Mitra Bestari dalam proses telaah.'],
            [0.5, 'Kebijakan AI tersedia tetapi hanya mengatur sebagian ketentuan.'],
            [0, 'Kebijakan AI tidak tersedia atau hanya berupa pernyataan umum.'],
        ]],
        'C.4' => ['label' => 'Kelengkapan Laman Jurnal Ilmiah', 'max' => 3, 'options' => [
            [3, 'Memenuhi 100% unsur COPE Principles of Transparency and Best Practice in Scholarly Publishing.'],
            [2, 'Memenuhi sekurang-kurangnya 75% dan kurang dari 100% unsur kelengkapan laman.'],
            [1, 'Memenuhi sekurang-kurangnya 50% dan kurang dari 75% unsur kelengkapan laman.'],
            [0, 'Memenuhi kurang dari 50% unsur kelengkapan laman.'],
        ]],
        'D.1' => ['label' => 'Jadwal Penerbitan', 'max' => 2, 'options' => [
            [2, 'Menerapkan sistem prapublikasi seperti Article in Press dan/atau Issue in Progress serta seluruh terbitan sesuai periode yang ditentukan selama 3 tahun terakhir.'],
            [1.5, 'Lebih dari 75% terbitan sesuai periode yang ditentukan.'],
            [1, 'Lebih dari 25% sampai 75% terbitan sesuai periode.'],
            [0.5, 'Paling banyak 25% terbitan sesuai periode.'],
            [0, 'Menggunakan konsep abstract only dan/atau menyisipkan artikel pada back issue.'],
        ]],
        'D.2' => ['label' => 'Sistem Penomoran Volume, Nomor Terbitan, dan Halaman/Identitas Artikel', 'max' => 1, 'options' => [
            [1, 'Penomoran volume, terbitan, dan halaman/identitas artikel sistematis dan konsisten selama 3 tahun terakhir.'],
            [0.5, 'Penomoran cukup baik dan/atau cukup konsisten.'],
            [0, 'Penomoran kurang baik dan/atau kurang konsisten.'],
        ]],
        'E.1' => ['label' => 'Dampak Ilmiah/Jumlah Sitasi', 'max' => 6, 'options' => [
            [6, 'Lebih dari 25 sitasi berdasarkan pengindeks bereputasi internasional dan/atau lebih dari 75 sitasi berdasarkan basis data DOI dalam 3 tahun terakhir.'],
            [4, '20-25 sitasi berdasarkan pengindeks bereputasi internasional dan/atau 31-75 sitasi berdasarkan basis data DOI dalam 3 tahun terakhir.'],
            [3, '10-19 sitasi berdasarkan pengindeks bereputasi internasional dan/atau 11-30 sitasi berdasarkan basis data DOI dalam 3 tahun terakhir.'],
            [2, '5-9 sitasi berdasarkan pengindeks bereputasi internasional dan/atau 5-10 sitasi berdasarkan basis data DOI dalam 3 tahun terakhir.'],
            [1, 'Kurang dari 5 sitasi dalam 3 tahun terakhir.'],
            [0, 'Data sitasi tidak dapat diverifikasi secara memadai.'],
        ]],
        'E.2' => ['label' => 'Visibilitas Jurnal Ilmiah', 'max' => 6, 'options' => [
            [6, 'Tercantum dan metadata terindeks di lembaga pengindeks bereputasi internasional.'],
            [4, 'Tercantum tetapi metadata belum terindeks di lembaga pengindeks bereputasi internasional.'],
            [3, 'Tercantum dan metadata terindeks di pengindeks internasional/nasional bersistem seleksi.'],
            [2, 'Tercantum tetapi metadata belum terindeks di pengindeks internasional/nasional bersistem seleksi.'],
            [1, 'Tercantum dan metadata terindeks di pengindeks internasional/nasional tidak bersistem seleksi.'],
        ]],
        'F.1' => ['label' => 'Judul Artikel', 'max' => 2, 'options' => [
            [2, 'Judul lugas dan memuat informasi temuan penting.'],
            [1, 'Judul lugas tetapi kurang memuat informasi temuan penting.'],
            [0, 'Judul tidak lugas dan tidak memuat informasi temuan penting.'],
        ]],
        'F.2' => ['label' => 'Abstrak', 'max' => 3, 'options' => [
            [3, 'Abstrak jelas dan ringkas dalam Bahasa Inggris, atau Bahasa Inggris dan Bahasa Indonesia.'],
            [2, 'Abstrak kurang jelas dan kurang ringkas.'],
            [0, 'Abstrak tidak jelas.'],
        ]],
        'F.3' => ['label' => 'Kata Kunci', 'max' => 1, 'options' => [
            [1, 'Kata kunci mencerminkan konsep penting artikel dan memudahkan pencarian.'],
            [0.5, 'Kata kunci kurang mencerminkan konsep penting.'],
            [0, 'Artikel tidak memuat kata kunci.'],
        ]],
        'F.4' => ['label' => 'Kepioniran Ilmiah/Orisinalitas/Kontribusi Kebaruan/Analisis Kesenjangan', 'max' => 7, 'options' => [
            [7, 'Karya orisinal dengan kontribusi kebaruan sangat tinggi; lengkap memuat state of the art, justifikasi kontribusi kebaruan/analisis kesenjangan, dan tujuan riset.'],
            [5, 'Kontribusi kebaruan tinggi; terdapat paling sedikit dua dari tiga komponen utama.'],
            [3, 'Kontribusi kebaruan cukup; hanya terdapat satu dari tiga komponen utama.'],
            [1, 'Kurang orisinal dan kurang memberikan kontribusi kebaruan atau tidak ada informasi analisis kesenjangan.'],
        ]],
        'F.5' => ['label' => 'Analisis dan Sintesis', 'max' => 8, 'options' => [
            [8, 'Analisis dan sintesis sangat baik dan sangat mendalam; mencakup metode penelitian, deskripsi temuan penting, kedalaman interpretasi, dan perbandingan dengan penelitian lain.'],
            [6, 'Analisis dan sintesis baik dan mendalam; satu dari empat aspek tidak ditemukan.'],
            [4, 'Analisis dan sintesis kurang baik dan kurang mendalam; dua dari empat aspek tidak ditemukan.'],
            [1, 'Analisis dan sintesis tidak baik dan tidak mendalam; tiga dari empat aspek tidak ditemukan.'],
        ]],
        'F.6' => ['label' => 'Penyimpulan', 'max' => 5, 'options' => [
            [5, 'Penyimpulan sangat baik, menjawab tujuan dan/atau memuat implikasi hasil riset.'],
            [3, 'Penyimpulan cukup baik dan cukup menjawab tujuan dan/atau memuat implikasi hasil riset.'],
            [1, 'Penyimpulan kurang baik dan kurang menjawab tujuan riset.'],
        ]],
        'F.7' => ['label' => 'Nisbah Sumber Acuan Primer Berbanding Sumber Lainnya', 'max' => 3, 'options' => [
            [3, 'Lebih dari 80% sumber primer dan jumlah rujukan minimal 15.'],
            [2, '40-80% sumber primer dan jumlah rujukan minimal 15.'],
            [1, 'Kurang dari 40% sumber primer dan jumlah rujukan minimal 15.'],
            [0.5, 'Jumlah rujukan kurang dari 15.'],
        ]],
        'F.8' => ['label' => 'Derajat Kemutakhiran Pustaka Acuan', 'max' => 3, 'options' => [
            [3, 'Lebih dari 80% rujukan merupakan pustaka mutakhir yang terbit dalam 10 tahun terakhir.'],
            [2, '40-80% rujukan merupakan pustaka mutakhir yang terbit dalam 10 tahun terakhir.'],
            [1, 'Kurang dari 40% rujukan merupakan pustaka mutakhir yang terbit dalam 10 tahun terakhir.'],
        ]],
        'F.9' => ['label' => 'Cakupan Keilmuan', 'max' => 2, 'options' => [
            [2, '100% artikel sesuai fokus dan ruang lingkup jurnal.'],
            [1.5, 'Sekurang-kurangnya 90% dan kurang dari 100% artikel sesuai fokus dan ruang lingkup jurnal.'],
            [1, 'Sekurang-kurangnya 80% dan kurang dari 90% artikel sesuai fokus dan ruang lingkup jurnal.'],
            [0.5, 'Kurang dari 80% artikel sesuai fokus dan ruang lingkup jurnal.'],
        ]],
        'G.1' => ['label' => 'Kelengkapan Galley/PDF Artikel', 'max' => 3, 'options' => [
            [3, 'Memenuhi 8 atau 9 unsur kelengkapan galley/PDF artikel.'],
            [2, 'Memenuhi 6 atau 7 dari 9 unsur kelengkapan galley/PDF artikel.'],
            [1, 'Memenuhi 4 atau 5 dari 9 unsur kelengkapan galley/PDF artikel.'],
            [0.5, 'Memenuhi hanya 1-3 unsur kelengkapan galley/PDF artikel.'],
        ]],
        'G.2' => ['label' => 'Pencantuman Nama Penulis dan Afiliasi', 'max' => 1, 'options' => [
            [1, 'Nama penulis dan afiliasi lengkap, benar, dan konsisten antarartikel.'],
            [0.5, 'Nama penulis dan afiliasi lengkap dan benar tetapi tidak konsisten antarartikel.'],
            [0, 'Nama penulis dan afiliasi tidak lengkap dan tidak konsisten.'],
        ]],
        'G.3' => ['label' => 'Sistematika Penulisan Artikel', 'max' => 2, 'options' => [
            [2, 'Sistematika lengkap, bersistem baik, dan konsisten antarartikel dan antar terbitan.'],
            [1, 'Sistematika lengkap dan bersistem baik tetapi tidak konsisten.'],
            [0.5, 'Sistematika kurang lengkap/kurang sistematis tetapi konsisten.'],
            [0, 'Sistematika kurang lengkap, kurang sistematis, dan tidak konsisten.'],
        ]],
        'G.4' => ['label' => 'Pemanfaatan Instrumen Pendukung', 'max' => 4, 'options' => [
            [4, 'Pemanfaatan instrumen pendukung efektif dan komplementer.'],
            [2, 'Pemanfaatan instrumen pendukung cukup efektif dan cukup komplementer.'],
            [0, 'Pemanfaatan instrumen pendukung tidak efektif dan tidak komplementer.'],
        ]],
        'G.5' => ['label' => 'Sistem Pengacuan Pustaka dan Konsistensi Daftar Pustaka', 'max' => 3, 'options' => [
            [3, 'Sistem pengacuan baku sesuai Author Guidelines dan 100% konsisten antarartikel.'],
            [2, 'Sistem pengacuan cukup baku dan konsisten pada 75% sampai kurang dari 100% artikel.'],
            [0, 'Sistem pengacuan tidak baku dan tingkat konsistensi kurang dari 75%.'],
        ]],
        'G.6' => ['label' => 'Penggunaan Istilah dan Kualitas Kebahasaan', 'max' => 4, 'options' => [
            [4, '100% artikel menggunakan istilah baku dan kualitas bahasa baik dan benar.'],
            [3, '75% sampai kurang dari 100% artikel menggunakan istilah baku dan bahasa yang baik.'],
            [1, '50% sampai kurang dari 75% artikel memenuhi salah satu atau sebagian aspek.'],
            [0, 'Sebagian besar artikel memiliki bahasa yang kurang baik dan kurang benar.'],
        ]],
        'G.7' => ['label' => 'Mutu Penyuntingan Substansi, Gaya Selingkung, dan Tata Letak', 'max' => 3, 'options' => [
            [3, 'Mutu penyuntingan substansi, gaya selingkung, dan tata letak sesuai standar artikel ilmiah dan konsisten antarartikel.'],
            [2, 'Mutu penyuntingan substansi, gaya selingkung, dan tata letak sesuai standar tetapi tidak konsisten antarartikel.'],
            [1, 'Mutu penyuntingan substansi, gaya selingkung, dan tata letak kurang sesuai standar dan/atau tidak konsisten.'],
        ]],
    ];
}
