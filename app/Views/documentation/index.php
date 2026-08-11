<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<?php
$sourceDocument = 'Penjelasan Unsur A–G Akreditasi Jurnal Ilmiah 2026 - Materi Dokumentasi Berdasarkan Petunjuk Teknis Akreditasi Jurnal Ilmiah';
$toc = [
    'ringkasan' => 'Ringkasan', 'alur-akreditasi' => 'Alur Akreditasi',
    'pemeriksaan-awal' => 'Pemeriksaan Awal', 'pemeriksaan-kelayakan' => 'Pemeriksaan Kelayakan',
    'unsur-bobot' => 'Unsur & Bobot Penilaian', 'unsur-a' => 'A. Konsistensi Identitas',
    'unsur-b' => 'B. Tata Kelola & Keberagaman', 'unsur-c' => 'C. Kelengkapan Laman',
    'unsur-d' => 'D. Keberkalaan', 'unsur-e' => 'E. Penyebarluasan',
    'unsur-f' => 'F. Mutu Artikel', 'unsur-g' => 'G. Penulisan & Penyuntingan',
    'disinsentif' => 'Disinsentif', 'peringkat' => 'Peringkat Akreditasi',
    'ketentuan-penting' => 'Ketentuan Penting', 'pengajuan' => 'Pengajuan Akreditasi',
    'masa-berlaku' => 'Masa Berlaku',
];
$flowSteps = [
    ['Pengajuan', 'Registrasi usulan dan data jurnal', '<path d="M12 16V4M7 9l5-5 5 5"/><path d="M5 14v5h14v-5"/>'],
    ['Pemeriksaan Awal', 'Kriteria minimum administratif dan teknis', '<path d="M7 3h10v3h3v15H4V6h3V3Z"/><path d="m8 13 2 2 5-5"/>'],
    ['Pemeriksaan Kelayakan', 'Peer-review dan integritas penerbit', '<path d="M12 3 4.5 6v5.5c0 4.5 3 7.6 7.5 9.5 4.5-1.9 7.5-5 7.5-9.5V6L12 3Z"/><path d="m8.5 12 2.2 2.2 4.8-5"/>'],
    ['Penilaian Tata Kelola', 'Unsur A–E, maksimum 46 poin', '<path d="M4 20V10M10 20V5M16 20v-8M22 20H2"/>'],
    ['Penilaian Mutu Artikel', 'Unsur F–G, maksimum 54 poin', '<path d="M5 4h11a3 3 0 0 1 3 3v13H7a2 2 0 0 1-2-2V4Z"/><path d="M8 9h7M8 13h7M8 17h4"/>'],
    ['Pemeriksaan Disinsentif', 'Pengurangan jika ditemukan pelanggaran', '<path d="M12 3 2.8 20h18.4L12 3Z"/><path d="M12 9v5M12 17h.01"/>'],
    ['Verifikasi dan Harmonisasi', 'Penelaahan dan penyelarasan hasil', '<circle cx="11" cy="11" r="6"/><path d="m16 16 4 4M8.5 11l1.7 1.7 3.5-3.7"/>'],
    ['Penetapan', 'Peringkat atau Tidak Terakreditasi', '<circle cx="12" cy="9" r="6"/><path d="m8.5 14-1 7 4.5-2 4.5 2-1-7"/><path d="m9.5 9 1.7 1.7L15 7"/>'],
];
$minimumCriteria = [
    ['e-ISSN valid', 'Memiliki e-ISSN; nama jurnal dan penerbit sesuai data ISSN; laman jurnal dapat diakses.'],
    ['Usia dan keberkalaan jurnal', 'Terbit sekurang-kurangnya 3 tahun berturut-turut; frekuensi sesuai e-ISSN; minimal 2 kali setahun; setiap terbitan minimal 5 artikel.'],
    ['Dewan Penyunting dan Mitra Bestari', 'Daftar editor dan reviewer tersedia; keahlian sesuai bidang jurnal; nama dan afiliasi valid; keberagaman afiliasi mencukupi.'],
    ['Etika publikasi', 'Tersedia kebijakan publication ethics yang mengacu pada standar COPE.'],
    ['Biaya penulis', 'Author Fees/APC dijelaskan secara transparan, termasuk apabila biaya Rp0.'],
    ['Kredensial Editor', 'Username dan password valid dengan peran Editor untuk menelusuri proses editorial.'],
    ['DOI aktif', 'Setiap artikel memiliki DOI aktif.'],
];
$initialChecks = [
    ['Nama dan laman jurnal', 'Validitas laman jurnal'], ['Nama dan laman jurnal', 'Validitas nama jurnal sesuai ISSN'],
    ['Nama dan laman jurnal', 'Validitas penerbit jurnal sesuai ISSN'], ['Usulan', 'Kesesuaian jenis dan waktu usulan'],
    ['Frekuensi dan keberkalaan', 'Kesesuaian frekuensi terbitan'], ['Frekuensi dan keberkalaan', 'Keberkalaan jurnal tiga tahun terakhir'],
    ['Frekuensi dan keberkalaan', 'Pencantuman peringkat dan masa berlaku'], ['Kelengkapan laman', 'Laman etika publikasi'],
    ['Kelengkapan laman', 'Laman biaya pemrosesan artikel'], ['Kelengkapan laman', 'Ketersediaan DOI aktif'],
    ['Kelengkapan laman', 'Ketersediaan teks penuh pada setiap artikel'], ['Editor', 'Kecukupan keberagaman afiliasi Tim Editor'],
    ['Mitra Bestari', 'Kecukupan keberagaman afiliasi Mitra Bestari'], ['Kredensial', 'Validitas username dan password'],
    ['Kredensial', 'Ketersediaan kredensial/peran Editor'],
];
$componentNotes = [
    'C.1' => ['Tipe review', 'Tahapan dan kriteria penelaahan', 'Kualifikasi dan jumlah reviewer', 'Batas waktu', 'Pemeriksaan similaritas', 'Pengambilan keputusan editorial'],
    'C.3' => ['Pengungkapan penggunaan AI oleh Penulis', 'Batas penggunaan AI oleh Editor', 'Larangan penggunaan AI oleh Mitra Bestari dalam proses telaah'],
    'C.4' => ['ISSN', 'Aim and Scope', 'Types of Manuscript', 'Publishing Schedule', 'Access', 'Contact Information', 'Copyright', 'Licensing', 'Ownership and Management', 'Authorship/Contributorship Criteria', 'Allegation of Research Misconduct', 'Post-publication Discussion', 'Correction and Retraction', 'Archiving', 'Conflict of Interest/Competing Interests', 'Plagiarism Policy'],
    'F.4' => ['State of the art', 'Justifikasi kebaruan/research gap', 'Tujuan penelitian'],
    'F.5' => ['Metode', 'Temuan penting', 'Kedalaman interpretasi', 'Perbandingan kritis dengan penelitian lain'],
    'G.1' => ['Identitas jurnal, volume/nomor/tahun/halaman atau article ID', 'Lisensi akses', 'Copyright', 'Riwayat artikel/history dates', 'DOI', 'Pernyataan penggunaan AI', 'Author Contribution Statement', 'Funding Statement', 'Conflict of Interest/Competing Interests Statement'],
];
$officialExplanations = [
    'A' => ['pages' => '10–11', 'points' => [
        'Nama jurnal harus bermakna ilmiah, selaras dengan disiplin, fokus, dan ruang lingkup, serta cukup unik untuk dibedakan dari jurnal lain.',
        'Nama sebaiknya mencerminkan bidang ilmu secara spesifik, tidak memakai nama instansi atau penerbit, dan menghindari penekanan lokasi yang berlebihan.',
        'Nama atau singkatan menggunakan istilah yang dikenal, mudah dipahami, dan tidak melanggar etika maupun norma.',
        'Penulisan nama wajib konsisten pada laman jurnal, metadata artikel, judul sirahan galley PDF, dan nama yang terdaftar pada basis data ISSN.',
    ]],
    'B.1' => ['pages' => '11–13', 'points' => [
        'Mitra Bestari harus berbeda dari Tim Editor, sesuai bidang kepakaran, berasal dari beragam institusi, dan benar-benar aktif menelaah artikel.',
        'Nama yang hanya dicantumkan tanpa bukti telaah tidak diperhitungkan. Bukti keterlibatan setiap reviewer harus dapat ditunjukkan pada sistem manajemen jurnal.',
        'Rekam jejak publikasi internasional dalam tiga tahun terakhir mensyaratkan sekurang-kurangnya satu artikel sebagai penulis utama/korespondensi atau menjadi penulis anggota pada sedikitnya tiga artikel di jurnal ilmiah internasional.',
        'Rekam jejak publikasi nasional memakai batas yang sama, tetapi artikelnya diterbitkan pada jurnal ilmiah nasional terakreditasi.',
        'Setiap artikel harus mempunyai bukti proses penelaahan; jurnal dapat menerapkan single-blind review atau double-blind review sesuai kebijakannya.',
        'Identitas serta afiliasi harus valid dan dapat diverifikasi. Identitas fiktif atau pencatutan memperoleh nilai terendah, dan proses telaah tidak boleh menggunakan AI.',
    ]],
    'B.2' => ['pages' => '13', 'points' => [
        'Dampak keterlibatan aktif Mitra Bestari terlihat pada kualitas dan konsistensi mutu substansi artikel yang diterbitkan.',
        'Telaah aktif dibuktikan melalui saran dan komentar substantif serta konstruktif, berikut dokumentasi korespondensi atau catatan manual/elektronik di platform jurnal.',
        'Komentar bermutu berfokus pada penjagaan standar isi artikel, bukan hanya persoalan bahasa atau tata letak.',
        'Nama reviewer dapat dicantumkan dalam daftar keseluruhan, bukan per nomor terbitan, agar prinsip blind review tetap terjaga. Penilaian mengamati konsistensi komentar selama tiga tahun terakhir.',
    ]],
    'B.3' => ['pages' => '13–15', 'points' => [
        'Keterlibatan aktif Editor in Chief dan Tim Editor harus terbukti dalam pengelolaan atau penelaahan artikel serta pengembangan jurnal.',
        'Untuk bidang Ilmu Sosial, acuan h-indeks minimum adalah 4 bagi Editor in Chief dan 3 bagi anggota Tim Editor.',
        'Untuk bidang Sains, Teknologi, Keteknikan, dan Matematika, acuan h-indeks minimum adalah 7 bagi Editor in Chief dan 5 bagi anggota Tim Editor. H-indeks mengacu pada basis data pengindeks bereputasi internasional.',
        'Jumlah editor dan cakupan kepakarannya harus memadai serta sesuai dengan fokus dan ruang lingkup jurnal.',
        'Struktur, kewenangan, dan tugas editor harus tegas. Pengangkatan didasarkan pada kualifikasi, pengalaman, komitmen, dan kontribusi, bukan semata jabatan ex-officio.',
        'Keberagaman institusi/negara, rekam jejak tiga tahun terakhir, bukti keterlibatan, serta validitas nama dan afiliasi menjadi dasar penilaian. Editor in Chief harus berafiliasi pada institusi berdomisili di Indonesia.',
    ]],
    'B.4' => ['pages' => '15', 'points' => [
        'Keberagaman penulis dihitung dari asal negara atau institusi pada setiap nomor terbitan selama tiga tahun terakhir.',
        'Jurnal seharusnya menerbitkan artikel dari beragam institusi atau negara agar tidak bersifat lokal; satu institusi saja selama tiga tahun memperoleh nilai nol.',
        'Nama dan afiliasi harus valid, disetujui pemilik identitas, dapat diverifikasi, dan setiap penulis memenuhi kriteria kontribusi kepengarangan.',
        'Penambahan penulis setelah naskah diterima tanpa alasan yang jelas tidak diperbolehkan dan tidak diakui sebagai keberagaman.',
    ]],
    'B.5' => ['pages' => '16', 'points' => [
        'Pengelolaan artikel yang efektif menggunakan sistem manajemen jurnal daring dengan metadata yang dapat dibaca mesin pengindeks.',
        'Alur daring mencakup registrasi, pengiriman, telaah, penyuntingan, pemeriksaan metadata dan praterbit, penerbitan, serta pemberian DOI.',
        'Kombinasi sistem daring dan surat elektronik dinilai lebih rendah; pengelolaan sepenuhnya melalui surat elektronik memperoleh nilai nol.',
    ]],
    'C.1' => ['pages' => '19–20', 'points' => [
        'Kebijakan proses penelaahan harus tersedia, jelas, lengkap, dapat diakses publik, dan ditautkan dari laman depan jurnal.',
        'Kebijakan sekurang-kurangnya memuat jenis blind review, tahapan dan kriteria, kualifikasi serta jumlah reviewer, batas waktu, pemeriksaan similaritas, dan keputusan editorial.',
        'Proses penelaahan harus selaras dengan prinsip etika publikasi yang diakui, termasuk pedoman peer review COPE.',
    ]],
    'C.2' => ['pages' => '20', 'points' => [
        'Petunjuk Penulisan harus menjelaskan dengan rinci substansi setiap bagian artikel agar gaya selingkung konsisten.',
        'Template dapat disediakan untuk memudahkan penulis, tetapi petunjuk lengkap tetap harus ditampilkan langsung pada laman jurnal, bukan hanya berupa tautan template.',
    ]],
    'C.3' => ['pages' => '20', 'points' => [
        'Jurnal wajib memiliki kebijakan AI untuk penulisan, penyuntingan, dan telaah sejawat yang dicantumkan secara jelas pada laman.',
        'Kebijakan minimal mengatur pengungkapan penggunaan AI oleh penulis dan editor serta melarang reviewer memakai AI untuk menganalisis, menilai, menyusun komentar, atau mengunggah naskah.',
        'AI tidak dapat dicantumkan sebagai penulis atau menggantikan penilaian ilmiah dan keputusan editorial; tanggung jawab atas orisinalitas, kerahasiaan, dan integritas tetap melekat pada manusia.',
    ]],
    'C.4' => ['pages' => '21–22', 'points' => [
        'Kelengkapan laman dinilai terhadap 16 klausul Principles of Transparency and Best Practice in Scholarly Publishing dari COPE.',
        'Klausul mencakup identitas dan ruang lingkup jurnal, jenis naskah, jadwal, akses, kontak, hak cipta, lisensi, kepemilikan, kepengarangan, pelanggaran riset, diskusi pascaterbit, koreksi/retraksi, pengarsipan, konflik kepentingan, dan plagiarisme.',
        'Nilai ditentukan dari persentase klausul yang dipenuhi. Desain laman tidak boleh mencampur dua bahasa dalam satu tampilan dan sampul sebaiknya memiliki ciri khas.',
    ]],
    'D.1' => ['pages' => '24–25', 'points' => [
        'Frekuensi dan jadwal penerbitan harus diumumkan pada laman serta dipenuhi secara konsisten; naskah sebaiknya diproses berkelanjutan tanpa menunggu nomor terbitan.',
        'Issue in Progress/Online First hanya untuk versi akhir, sedangkan Article in Press/Accepted Manuscript harus menyediakan teks penuh untuk naskah yang masih dalam tahap produksi.',
        'Penerbitan abstract only tidak diterima sebagai prapublikasi. Artikel juga tidak boleh disisipkan ke nomor lama yang telah resmi terbit (back issue).',
        'Prapublikasi bertujuan mempercepat akses, pengindeksan, sitasi, dan kepastian hak cipta penulis.',
    ]],
    'D.2' => ['pages' => '25', 'points' => [
        'Volume dan nomor terbitan menggunakan sistem penomoran yang baik dan angka Arab.',
        'Pada volume baru, penomoran halaman dimulai kembali dari halaman pertama; identitas unik artikel dapat dipakai sebagai pengganti nomor halaman berkelanjutan.',
        'Penilaian menitikberatkan kebakuan dan konsistensi sistem pada terbitan tiga tahun terakhir.',
    ]],
    'E.1' => ['pages' => '26–27', 'points' => [
        'Jumlah sitasi menunjukkan dampak dan kebermanfaatan artikel; indikator lain seperti unduhan, kunjungan, impact factor, dan h-index dapat membantu membaca kinerja jurnal.',
        'Data sitasi harus berasal dari penyedia metadata yang terpercaya dan tidak bias, seperti pengindeks bereputasi internasional atau basis data DOI yang sesuai.',
        'Jurnal tanpa sitasi selama tiga tahun dinilai kurang berdampak atau kurang aktif mendiseminasikan informasi. Penilaian memakai jumlah sitasi tiga tahun terakhir.',
    ]],
    'E.2' => ['pages' => '27', 'points' => [
        'Pengindeksan bertujuan mendiseminasikan metadata agar artikel lebih mudah ditemukan pembaca.',
        'Tingkat nilai mempertimbangkan ketatnya seleksi: pengindeks bereputasi internasional, pengindeks internasional/nasional dengan seleksi, atau pengindeks tanpa seleksi.',
        'Setelah jurnal diterima pada pengindeks, metadata artikel harus terus diunggah dan dipantau. Tercantum sebagai jurnal tetapi metadata belum terindeks dapat menurunkan nilai.',
    ]],
    'F.1' => ['pages' => '29', 'points' => [
        'Judul harus memuat informasi temuan penting, menggambarkan isi secara spesifik, lugas, dan informatif.',
        'Artikel berbahasa Indonesia memakai judul Indonesia dan Inggris; artikel penuh berbahasa Inggris cukup memakai judul Inggris. Bahasa metadata harus sesuai bahasa teks penuh.',
        'Lokasi riset umumnya tidak perlu dicantumkan, kecuali karakter wilayah memang menjadi substansi kajian.',
    ]],
    'F.2' => ['pages' => '29–30', 'points' => [
        'Abstrak merupakan metadata penting, bukan sekadar ringkasan, dan idealnya memuat latar penting, tujuan, metode singkat, temuan, serta simpulan singkat.',
        'Abstrak harus ringkas, jelas, utuh, tanpa rujukan pustaka, gambar, atau tabel, dan menggambarkan esensi tulisan.',
        'Artikel Indonesia menyediakan abstrak Indonesia dan Inggris; artikel penuh Inggris cukup menyediakan abstrak Inggris. Beberapa jenis artikel khusus dapat mengikuti struktur berbeda.',
    ]],
    'F.3' => ['pages' => '30', 'points' => [
        'Kata kunci merupakan metadata untuk membantu temu kembali artikel melalui mesin pencari.',
        'Kata atau frasa dipilih secara cermat dan baku agar mewakili konsep serta substansi artikel. Penilaian didasarkan pada keterwakilan konsep isi.',
    ]],
    'F.4' => ['pages' => '30–31', 'points' => [
        'Pendahuluan perlu memuat state of the art yang relevan, justifikasi kontribusi kebaruan atau analisis research gap, dan tujuan riset yang jelas.',
        'Jurnal mengutamakan hasil riset orisinal; artikel ulasan atau studi kasus dibatasi kecuali menjadi kekhususan jurnal.',
        'Studi kasus/komunikasi pendek tetap harus memiliki tujuan atau hipotesis, metode, hasil dan analisis, serta simpulan. Artikel ulasan harus komprehensif, mutakhir, dan memuat analisis orisinal penulis.',
    ]],
    'F.5' => ['pages' => '31', 'points' => [
        'Analisis dan sintesis yang tajam mencakup metode yang sesuai, temuan penting berbasis data, hubungan dengan konsep atau teori, dan interpretasi yang mendalam.',
        'Temuan perlu dibandingkan secara kritis dengan penelitian relevan dan mutakhir sehingga dapat menguatkan atau mengoreksi pengetahuan sebelumnya.',
        'Deskripsi hasil tanpa interpretasi, pembahasan, atau perbandingan dengan riset lain dinilai paling rendah.',
    ]],
    'F.6' => ['pages' => '31–32', 'points' => [
        'Simpulan harus menjawab tujuan riset, menegaskan temuan baru atau penting, dan dapat memuat rekomendasi, implikasi, atau arah riset lanjut.',
        'Simpulan wajib didukung fakta hasil riset. Paragraf simpulan di akhir Hasil dan Pembahasan tetap dapat diakui walau tidak memiliki bab tersendiri.',
        'Simpulan yang tidak menjawab tujuan atau masih berisi pembahasan luas dinilai paling rendah.',
    ]],
    'F.7' => ['pages' => '32', 'points' => [
        'Proporsi sumber primer menunjukkan bobot gagasan yang mendukung state of the art dan justifikasi kebaruan.',
        'Penilaian didasarkan pada persentase literatur primer dengan syarat minimal 15 rujukan per artikel; kurang dari itu tetap dinilai rendah.',
        'Sumber primer meliputi artikel jurnal, prosiding, disertasi, tesis, skripsi, manuskrip kuno, monograf hasil riset, atau hasil riset langsung lainnya.',
    ]],
    'F.8' => ['pages' => '32–33', 'points' => [
        'Kemutakhiran dihitung dari persentase pustaka yang terbit dalam sepuluh tahun terakhir.',
        'Karya klasik yang relevan tetap dapat dipakai sebagai dasar masalah atau teori, tetapi bukan sebagai pembanding temuan mutakhir maupun justifikasi kebaruan.',
    ]],
    'F.9' => ['pages' => '33', 'points' => [
        'Nilai ditentukan dari persentase artikel yang konsisten dengan fokus dan ruang lingkup jurnal.',
        'Pendekatan antardisiplin yang berfokus pada satu masalah tidak otomatis dianggap bunga rampai.',
        'Jurnal dinilai sebagai bunga rampai bila memuat artikel dari bidang-bidang yang tidak saling berkaitan dan memperoleh nilai terendah.',
    ]],
    'G.1' => ['pages' => '37', 'points' => [
        'Setiap artikel harus tersedia sebagai teks penuh pada URL unik, sekurang-kurangnya dalam PDF, dengan informasi bibliografis lengkap pada halaman pertama.',
        'Metadata galley mencakup sirahan jurnal, volume/nomor/tahun/halaman atau identitas artikel, lisensi, hak cipta, riwayat naskah, dan DOI.',
        'Artikel juga memuat deklarasi penggunaan AI, kontribusi penulis, pendanaan, dan konflik kepentingan pada bagian yang mudah ditemukan.',
        'Identitas dalam galley/PDF harus konsisten dengan metadata pada laman artikel.',
    ]],
    'G.2' => ['pages' => '38', 'points' => [
        'Metadata nama penulis sekurang-kurangnya terdiri dari nama depan dan belakang; nama belakang tidak disingkat satu huruf dan nama tidak disertai gelar atau jabatan.',
        'Jika penulis hanya mempunyai satu kata nama, nama pertama dan nama kedua pada metadata dapat diisi dengan kata yang sama agar metadata tetap terbaca dengan baik.',
        'Afiliasi dan alamat korespondensi harus lengkap, konsisten, tidak disingkat, serta memuat institusi, kota, dan negara.',
        'Kode afiliasi menunjukkan perbedaan institusi, bukan perbedaan penulis. Penilaian didasarkan pada kelengkapan dan konsistensi antarartikel.',
    ]],
    'G.3' => ['pages' => '38–39', 'points' => [
        'Artikel empiris umumnya memuat pendahuluan, metode, hasil dan pembahasan, serta simpulan.',
        'Jenis artikel atau bidang tertentu dapat memakai susunan berbeda, tetapi harus sesuai Petunjuk Penulisan dan konsisten antarartikel serta antarterbitan.',
    ]],
    'G.4' => ['pages' => '39', 'points' => [
        'Instrumen pendukung mencakup kebakuan tanda baca, kapital, huruf miring/tebal, kata majemuk, angka dan singkatan, tabel, gambar/grafik, resolusi, persamaan, serta simbol.',
        'Setiap instrumen harus dirujuk dan dijelaskan dalam artikel, disajikan lengkap, jelas, baku, dan konsisten antarartikel maupun antarterbitan.',
    ]],
    'G.5' => ['pages' => '39–40', 'points' => [
        'Cara kutipan dan format daftar pustaka harus baku, sesuai Petunjuk Penulisan, dan konsisten antarartikel serta antarterbitan.',
        'Aplikasi pengelola referensi dianjurkan, tetapi kesesuaian hasil dengan gaya yang ditetapkan tetap menjadi ukuran utama.',
        'Setiap kutipan harus ada di daftar pustaka dan setiap pustaka harus dirujuk dalam artikel. Nilai ditentukan dari persentase artikel yang konsisten.',
        'Pengacuan sekunder berantai, misalnya “sumber A dalam sumber B dalam sumber C”, bukan praktik pengacuan yang baku dan sebaiknya dihindari.',
    ]],
    'G.6' => ['pages' => '40', 'points' => [
        'Istilah harus baku sesuai bidang ilmu dan menggunakan standar bahasa yang baik dan benar.',
        'Nilai tertinggi diberikan jika 100% artikel memenuhi kualitas istilah dan kebahasaan; 75% sampai kurang dari 100% memperoleh nilai berikutnya; 50% sampai kurang dari 75% memperoleh nilai rendah; dan sebagian besar artikel dengan bahasa kurang baik memperoleh nilai 0.',
    ]],
    'G.7' => ['pages' => '41', 'points' => [
        'Tim Editor bertanggung jawab menjaga mutu substansi, gaya selingkung, dan format tata letak sesuai kaidah artikel ilmiah.',
        'Penilaian melihat konsistensi penyuntingan dan tampilan antarartikel serta antarnomor terbitan yang diusulkan.',
    ]],
];
$managementNotes = [
    'A' => [
        'Pastikan nama jurnal di sistem sama dengan nama yang terdaftar pada ISSN.',
        'Periksa konsistensi nama jurnal pada laman, metadata, dan PDF seluruh artikel.',
        'Jangan menggunakan variasi singkatan yang berbeda-beda.',
        'Hindari perubahan nama tanpa pemutakhiran data ISSN.',
        'Identitas jurnal harus konsisten pada seluruh representasi jurnal, bukan hanya halaman utama.',
    ],
    'B.1' => [
        'Jangan menambahkan nama reviewer hanya untuk memperbanyak daftar.',
        'Pastikan setiap reviewer mempunyai tugas review yang dapat dibuktikan.',
        'Pastikan kepakaran reviewer relevan dengan manuskrip yang ditelaah.',
        'Simpan keputusan, komentar, dan komunikasi review pada sistem jurnal.',
        'Pastikan nama dan afiliasi reviewer dapat diverifikasi.',
        'Jangan menggunakan AI untuk melakukan penilaian sejawat.',
    ],
    'B.2' => [
        'Komentar review perlu memeriksa ketepatan masalah atau tujuan.',
        'Komentar review perlu memeriksa kecukupan metode dan validitas temuan.',
        'Komentar review perlu memeriksa kedalaman pembahasan dan penggunaan literatur.',
        'Komentar review perlu memeriksa ketepatan simpulan dan kontribusi ilmiah artikel.',
    ],
    'B.3' => [
        'Jangan memilih editor semata-mata karena jabatan struktural.',
        'Pastikan aktivitas editor dapat dilacak pada sistem jurnal.',
        'Pastikan komposisi kepakaran mencakup fokus dan ruang lingkup jurnal.',
        'Perluas keberagaman institusi dan negara secara nyata.',
        'Pastikan Editor in Chief berafiliasi pada institusi yang berdomisili di Indonesia.',
    ],
    'B.4' => ['Keberagaman harus berasal dari jangkauan jurnal yang nyata, bukan manipulasi metadata atau penambahan nama penulis.'],
    'B.5' => ['Seluruh alur editorial sebaiknya dapat ditelusuri di sistem jurnal, bukan dipindahkan ke komunikasi pribadi yang tidak terdokumentasi.'],
    'C.1' => ['Jangan hanya menyatakan bahwa artikel direview; jelaskan bagaimana proses review benar-benar berlangsung.'],
    'C.2' => [
        'Jelaskan jenis manuskrip dan struktur artikel.',
        'Jelaskan isi yang diharapkan pada setiap bagian artikel.',
        'Jelaskan sistem sitasi serta format tabel dan gambar.',
        'Jelaskan metadata penulis, etika publikasi, dan format file yang diterima.',
    ],
    'D.1' => [
        'Tetapkan bulan penerbitan secara jelas dan jaga konsistensinya selama tiga tahun.',
        'Jangan memundurkan tanggal publikasi untuk menutup keterlambatan.',
        'Jangan menambahkan artikel secara retroaktif pada nomor terbitan yang telah selesai.',
    ],
    'E.2' => ['Status terdaftar pada pengindeks berbeda dengan kondisi metadata artikel benar-benar telah terindeks.'],
];
$importantRules = [
    'Artikel riset asli minimal 60% dari jumlah artikel tiap terbitan, kecuali jurnal khusus review/case report.',
    'Jurnal perlu memiliki kebijakan ketersediaan data dan reproducibility.',
    'Laman Mitra Bestari dipisahkan dari laman Tim Editor.',
    'Nama reviewer tidak dicantumkan per nomor terbitan agar blind review tetap terjaga.',
    'Special Issue di luar jadwal reguler atau Supplementary Issue tertentu tidak diperhitungkan.',
    'Perubahan jumlah artikel/nomor terbitan diperbolehkan secara wajar dengan mutu tetap terjaga.',
    'Self-citation berlebihan atau tidak wajar dapat mengurangi nilai.',
    'APC wajib transparan, termasuk bila biaya Rp0.',
    'Tidak boleh menjanjikan fast-track yang menjamin acceptance.',
    'Keputusan editorial harus independen.',
    'LoA tidak boleh diterbitkan sebelum naskah berstatus accepted.',
    'Dilarang menjanjikan hasil akreditasi atau memanipulasi sitasi, metadata, dan tanggal penerbitan.',
];
$activeDataUrl = site_url('jurnal/data');
$activeCriteriaUrl = $activeJournal['criteria_url'] ?? site_url('jurnal/data');
$activeRubricUrl = $activeJournal['rubric_url'] ?? site_url('jurnal/data');
$formatNumber = static function ($number): string {
    $value = number_format((float) $number, 1, ',', '.');
    return str_ends_with($value, ',0') ? substr($value, 0, -2) : $value;
};
?>

<style>
html{scroll-behavior:smooth}.docs-page{max-width:1500px;margin:0 auto;color:#1b2d43}.docs-hero{position:relative;overflow:hidden;display:flex;justify-content:space-between;gap:28px;padding:29px 31px;border-radius:18px;background:linear-gradient(130deg,#173f75,#2866a7);color:#fff;box-shadow:0 13px 32px rgba(23,63,117,.15)}.docs-hero::after{content:"";position:absolute;right:-70px;top:-130px;width:300px;height:300px;border:1px solid rgba(255,255,255,.13);border-radius:50%;box-shadow:0 0 0 45px rgba(255,255,255,.035),0 0 0 90px rgba(255,255,255,.02)}.docs-hero__copy,.docs-badge{position:relative;z-index:1}.docs-kicker{margin:0 0 7px;color:#cee3fb;font-size:.72rem;font-weight:600;letter-spacing:.09em;text-transform:uppercase}.docs-hero h1{max-width:800px;margin:0;font-size:clamp(1.6rem,3vw,2.25rem);line-height:1.2}.docs-hero p:last-child{max-width:760px;margin:10px 0 0;color:#e0edfb;font-size:.86rem;line-height:1.6}.docs-badge{align-self:flex-start;padding:8px 11px;border:1px solid rgba(255,255,255,.22);border-radius:999px;background:rgba(255,255,255,.11);font-size:.72rem;font-weight:600;white-space:nowrap}.docs-notice{display:flex;gap:13px;margin:18px 0;padding:15px 17px;border:1px solid #b8d2eb;border-radius:12px;background:#edf6ff;color:#264b70;font-size:.8rem;line-height:1.55}.docs-notice svg{width:21px;height:21px;flex:none;color:#2768a8}.docs-layout{display:grid;grid-template-columns:260px minmax(0,1fr);gap:20px;align-items:start}.docs-toc{position:sticky;top:18px;max-height:calc(100vh - 36px);overflow-y:auto;padding:16px;border:1px solid #e0e7ef;border-radius:14px;background:#fff;box-shadow:0 7px 22px rgba(23,45,73,.06)}.docs-toc h2{margin:2px 8px 11px;color:#718299;font-size:.68rem;letter-spacing:.09em;text-transform:uppercase}.docs-toc a{display:block;padding:8px 9px;border-radius:8px;color:#52667d;text-decoration:none;font-size:.75rem;line-height:1.35}.docs-toc a:hover,.docs-toc a.active{background:#eaf3fd;color:#17477d;font-weight:600}.docs-mobile-toc{display:none;margin-bottom:14px}.docs-content{min-width:0}.doc-section{scroll-margin-top:18px;margin-bottom:17px;padding:24px 26px;border:1px solid #e1e8f0;border-radius:15px;background:#fff;box-shadow:0 7px 22px rgba(23,45,73,.055)}.section-heading{display:flex;align-items:flex-start;justify-content:space-between;gap:18px;margin-bottom:16px;padding-bottom:14px;border-bottom:1px solid #e7edf3}.section-heading h2{margin:0;font-size:1.22rem;line-height:1.35}.section-heading p{margin:5px 0 0;color:#697b90;font-size:.78rem;line-height:1.5}.section-code{width:40px;height:40px;flex:none;display:grid;place-items:center;border-radius:11px;background:#17477d;color:#fff;font-weight:700}.heading-copy{display:flex;gap:12px}.max-badge{flex:none;padding:6px 10px;border-radius:999px;background:#eaf3fd;color:#1f5e9d;font-size:.7rem;font-weight:600;white-space:nowrap}.doc-section>p{color:#53677e;font-size:.82rem;line-height:1.7}.docs-table-wrap{overflow-x:auto;border:1px solid #dce5ee;border-radius:11px}.docs-table{min-width:650px;width:100%;margin:0;border-collapse:collapse}.docs-table th{padding:10px 12px;background:#f3f7fb;color:#4f647b;font-size:.69rem;letter-spacing:.045em;text-transform:uppercase}.docs-table td{padding:10px 12px;border-top:1px solid #e5ebf1;color:#33485f;font-size:.77rem;line-height:1.5;vertical-align:top}.docs-table th:first-child,.docs-table td:first-child{width:58px;text-align:center}.docs-table .numeric{text-align:center;white-space:nowrap;font-weight:600}.doc-callout{margin:15px 0;padding:13px 15px;border-left:4px solid #d79a20;border-radius:8px;background:#fff7e5;color:#775411;font-size:.78rem;line-height:1.55}.doc-callout.info{border-left-color:#3478ba;background:#edf6ff;color:#315a81}.flow-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px}.flow-step{position:relative;padding:14px;border:1px solid #dce5ee;border-radius:11px;background:#fafcff}.flow-number{width:28px;height:28px;display:grid;place-items:center;border-radius:8px;background:#17477d;color:#fff;font-size:.72rem;font-weight:700}.flow-step strong{display:block;margin-top:9px;font-size:.76rem}.flow-step span{display:block;margin-top:4px;color:#738397;font-size:.68rem;line-height:1.4}.score-summary{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin:16px 0}.summary-card{padding:17px;border:1px solid #dae5ef;border-radius:12px;background:#f7faff}.summary-card span{display:block;color:#667b92;font-size:.72rem}.summary-card strong{display:block;margin-top:5px;color:#173f75;font-size:1.45rem}.summary-card.total{background:#173f75;color:#fff}.summary-card.total span,.summary-card.total strong{color:#fff}.eligibility-grid,.feature-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}.info-card{padding:16px;border:1px solid #dce5ee;border-radius:11px;background:#fafcff}.info-card strong{display:block;font-size:.83rem}.info-card p{margin:7px 0 0;color:#65788d;font-size:.76rem;line-height:1.55}.standard-banner{display:flex;align-items:center;justify-content:space-between;gap:15px;margin:23px 0 14px;padding:17px 19px;border-radius:13px;background:#eaf3fd;color:#17477d}.standard-banner.quality{background:#edf7f3;color:#176349}.standard-banner h2{margin:0;font-size:1.05rem}.standard-banner strong{font-size:1.2rem}.subrubric{margin-top:17px;padding-top:17px;border-top:1px solid #e7edf3}.subrubric:first-of-type{margin-top:0;padding-top:0;border-top:0}.subrubric-head{display:flex;justify-content:space-between;gap:12px;margin-bottom:10px}.subrubric h3{margin:0;font-size:.9rem;line-height:1.4}.subrubric-score{color:#1f5e9d;font-size:.72rem;font-weight:600;white-space:nowrap}.component-list{display:grid;grid-template-columns:repeat(2,1fr);gap:6px 15px;margin:10px 0 13px;padding:12px 14px;border-radius:9px;background:#f5f8fb;counter-reset:components}.component-list li{list-style:none;position:relative;padding-left:23px;color:#53677d;font-size:.72rem;line-height:1.45;counter-increment:components}.component-list li::before{content:counter(components);position:absolute;left:0;top:1px;width:17px;height:17px;display:grid;place-items:center;border-radius:5px;background:#dceafa;color:#245f99;font-size:.59rem;font-weight:700}.warning-section{border-color:#efd2a0;background:#fffdf8}.warning-grid{display:grid;grid-template-columns:1fr 1fr;gap:13px}.warning-card{padding:16px;border:1px solid #efd7ae;border-radius:11px;background:#fff8eb}.warning-card h3{margin:0 0 8px;color:#875d10;font-size:.86rem}.warning-card p,.warning-card li{color:#705b38;font-size:.74rem;line-height:1.55}.checklist{display:grid;grid-template-columns:repeat(2,1fr);gap:9px;margin:0;padding:0}.checklist li{list-style:none;position:relative;padding:11px 12px 11px 39px;border:1px solid #e0e7ef;border-radius:10px;color:#435970;font-size:.75rem;line-height:1.5}.checklist li::before{content:"✓";position:absolute;left:12px;top:11px;width:19px;height:19px;display:grid;place-items:center;border-radius:6px;background:#e2f5ec;color:#168052;font-size:.7rem;font-weight:700}.submission-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:11px}.submission-card{padding:15px;border:1px solid #dce5ee;border-radius:11px}.submission-card h3{margin:0 0 9px;font-size:.82rem}.submission-card p,.submission-card li{color:#61758b;font-size:.72rem;line-height:1.55}.submission-card ul{margin:0;padding-left:17px}.feature-grid{grid-template-columns:repeat(3,1fr)}.feature-card{display:flex;flex-direction:column;padding:16px;border:1px solid #dae4ee;border-radius:11px;background:#fafcff}.feature-card h3{margin:0;font-size:.82rem}.feature-card p{flex:1;margin:7px 0 13px;color:#687a8e;font-size:.72rem;line-height:1.5}.feature-link{align-self:flex-start;padding:7px 10px;border-radius:8px;background:#17477d;color:#fff;text-decoration:none;font-size:.68rem;font-weight:600}.back-top{position:fixed;z-index:15;right:22px;bottom:22px;width:42px;height:42px;display:grid;place-items:center;border-radius:11px;background:#17477d;color:#fff;text-decoration:none;box-shadow:0 8px 20px rgba(23,63,117,.22)}.back-top svg{width:18px;height:18px}
@media(max-width:1050px){.docs-layout{grid-template-columns:1fr}.docs-toc{display:none}.docs-mobile-toc{display:block}.docs-mobile-toc select{height:44px;margin:0;border-radius:9px}.flow-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:700px){.docs-hero,.doc-section{padding:20px}.docs-hero{display:block}.docs-badge{display:inline-flex;margin-top:15px}.section-heading{display:block}.max-badge{display:inline-block;margin-top:10px}.score-summary,.eligibility-grid,.warning-grid,.checklist,.submission-grid,.feature-grid{grid-template-columns:1fr}.component-list{grid-template-columns:1fr}.flow-grid{grid-template-columns:1fr 1fr}.docs-table{min-width:580px}.back-top{right:13px;bottom:13px}}
.flow-top{display:flex;align-items:center;justify-content:space-between;gap:10px}.flow-icon{width:38px;height:38px;display:grid!important;place-items:center;border-radius:10px;background:#e7f1fc;color:#174f87;margin:0!important}.flow-icon svg{width:20px;height:20px}.flow-index{display:grid!important;place-items:center;width:25px;height:25px;margin:0!important;border:1px solid #d7e2ee;border-radius:8px;background:#fff;color:#6b7e93!important;font-size:.62rem!important;font-weight:700}.flow-step strong{margin-top:12px}.flow-step:hover{border-color:#b8d1e9;background:#f7fbff;box-shadow:0 5px 14px rgba(23,71,125,.07)}
.docs-table-wrap{width:100%;max-width:100%;min-width:0}.docs-table th:first-child,.docs-table td:first-child{width:auto;text-align:left}.warning-grid{grid-template-columns:minmax(0,1.35fr) minmax(0,.65fr)}.warning-card{min-width:0;overflow:hidden}.warning-card .docs-table{min-width:420px}.warning-card .docs-table th:last-child,.warning-card .docs-table td:last-child{width:120px;text-align:center}.subrubric .docs-table th:first-child,.subrubric .docs-table td:first-child{width:85px;text-align:center}#pemeriksaan-awal .docs-table th:first-child,#pemeriksaan-awal .docs-table td:first-child{width:58px;text-align:center}#unsur-bobot .docs-table th:first-child,#unsur-bobot .docs-table td:first-child{width:70px;text-align:center}
.official-explanation{margin-top:13px;padding:15px 17px;border:1px solid #cfe0f1;border-radius:11px;background:#f6faff}.official-explanation__head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:9px}.official-explanation__title{display:flex;align-items:center;gap:8px;color:#17477d;font-size:.76rem;font-weight:700}.official-explanation__icon{width:24px;height:24px;display:grid;place-items:center;border-radius:7px;background:#deecfa;color:#1d5d99}.official-explanation__icon svg{width:14px;height:14px}.official-explanation__source{color:#6b7f94;font-size:.66rem;white-space:nowrap}.official-explanation ol{margin:0;padding-left:20px}.official-explanation li{padding-left:3px;color:#455d75;font-size:.74rem;line-height:1.6}.official-explanation li+li{margin-top:5px}
.management-notes{margin-top:12px;padding:14px 16px;border:1px solid #e5dcc0;border-radius:10px;background:#fffaf0}.management-notes h4{margin:0 0 8px;color:#75591d;font-size:.76rem}.management-notes ul{margin:0;padding-left:19px}.management-notes li{color:#66583b;font-size:.73rem;line-height:1.55}.management-notes li+li{margin-top:4px}
.source-document{display:flex;align-items:flex-start;gap:11px;margin:0 0 18px;padding:13px 15px;border:1px solid #bcd5ec;border-radius:11px;background:#f2f8ff;color:#365b7f;font-size:.74rem;line-height:1.55}.source-document svg{width:20px;height:20px;flex:none;margin-top:1px;color:#17538b}.source-document strong{display:block;margin-bottom:2px;color:#17477d}.source-document span{display:block}
@media(max-width:900px){.warning-grid{grid-template-columns:1fr}.warning-card .docs-table{min-width:560px}}
@media(max-width:600px){.official-explanation__head{align-items:flex-start;flex-direction:column}.official-explanation__source{white-space:normal}}
</style>

<div class="docs-page" id="top">
    <header class="docs-hero"><div class="docs-hero__copy"><p class="docs-kicker">Pusat Panduan dan Referensi</p><h1>Dokumentasi Akreditasi Jurnal Ilmiah</h1><p>Panduan pemeriksaan kesiapan, evaluasi diri, unsur penilaian, dan peringkat Akreditasi Jurnal Ilmiah 2026 berdasarkan Keputusan Direktur Jenderal Sains dan Teknologi Nomor 374/DST/D.D1/HM.01.01/2026.</p></div></header>
    <div class="docs-notice"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 10v6M12 7h.01"/></svg><div><strong>Dokumentasi simulasi.</strong> Dokumentasi ini digunakan sebagai panduan simulasi dan evaluasi diri. Hasil pada aplikasi bukan keputusan resmi akreditasi.</div></div>
    <div class="source-document"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 3h9l3 3v15H6z"/><path d="M15 3v4h4M9 11h6M9 15h6"/></svg><div><strong>Sumber tunggal penjelasan A–G</strong><span><?= esc($sourceDocument) ?>. Uraian dan catatan pengelola pada setiap subunsur hanya menggunakan materi dari lampiran teks ini.</span></div></div>
    <label class="docs-mobile-toc"><span class="field-label">Daftar Isi</span><select onchange="if(this.value){location.hash=this.value}"><?php foreach ($toc as $anchor => $label): ?><option value="#<?= $anchor ?>"><?= esc($label) ?></option><?php endforeach ?></select></label>
    <div class="docs-layout">
        <aside class="docs-toc" aria-label="Daftar isi dokumentasi"><h2>Daftar Isi</h2><?php foreach ($toc as $anchor => $label): ?><a href="#<?= $anchor ?>"><?= esc($label) ?></a><?php endforeach ?></aside>
        <main class="docs-content">
            <section class="doc-section" id="ringkasan"><div class="section-heading"><div><h2>Ringkasan</h2><p>Gambaran dasar proses Akreditasi Jurnal Ilmiah 2026.</p></div></div><p>Seluruh alur pemeriksaan dan komponen penilaian di dalam sistem Simulasi Akreditasi Jurnal ini disusun berdasarkan <strong>Keputusan Direktur Jenderal Sains dan Teknologi Nomor 374/DST/D.D1/HM.01.01/2026 tentang Petunjuk Teknis Akreditasi Jurnal Ilmiah</strong>.</p><p>Akreditasi dilaksanakan melalui tahapan berurutan. Jurnal tidak langsung dinilai dengan angka: seluruh persyaratan minimum pada Pemeriksaan Awal dan Pemeriksaan Kelayakan harus dipenuhi sebelum penilaian Tata Kelola dan Mutu Artikel.</p><div class="feature-grid"><article class="feature-card"><h3>Data Jurnal</h3><p>Pastikan identitas dan data dasar jurnal lengkap serta konsisten.</p><a class="feature-link" href="<?= $activeDataUrl ?>">Buka Data Jurnal</a></article><article class="feature-card"><h3>Evaluasi Kriteria</h3><p>Lakukan Pemeriksaan Awal dan Pemeriksaan Kelayakan.</p><a class="feature-link" href="<?= $activeCriteriaUrl ?>">Buka Evaluasi Kriteria</a></article><article class="feature-card"><h3>Evaluasi Tata Kelola dan Mutu Artikel</h3><p>Nilai seluruh Unsur A–G berdasarkan kondisi dan bukti jurnal.</p><a class="feature-link" href="<?= $activeRubricUrl ?>">Buka Evaluasi Diri</a></article></div></section>

            <section class="doc-section" id="alur-akreditasi"><div class="section-heading"><div><h2>Alur Akreditasi</h2><p>Delapan tahap dari pengajuan hingga penetapan.</p></div></div><div class="flow-grid"><?php foreach ($flowSteps as $index => [$step, $copy, $icon]): ?><article class="flow-step"><div class="flow-top"><span class="flow-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><?= $icon ?></svg></span><span class="flow-index"><?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?></span></div><strong><?= esc($step) ?></strong><span><?= esc($copy) ?></span></article><?php endforeach ?></div><div class="score-summary"><div class="summary-card"><span>Standar Tata Kelola A–E</span><strong>46 poin</strong></div><div class="summary-card"><span>Standar Mutu Artikel F–G</span><strong>54 poin</strong></div><div class="summary-card total"><span>Total maksimum</span><strong>100 poin</strong></div></div><div class="doc-callout info">Disinsentif bukan bagian dari maksimum 100 poin. Disinsentif merupakan pengurangan nilai apabila kondisi pelanggaran yang ditentukan ditemukan.</div></section>

            <section class="doc-section" id="pemeriksaan-awal"><div class="section-heading"><div><h2>Pemeriksaan Awal</h2><p>Prasyarat formal sebelum Pemeriksaan Kelayakan.</p></div></div><h3>7 Kriteria Minimum</h3><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>No.</th><th>Kriteria Minimum</th><th>Indikator Pemenuhan</th></tr></thead><tbody><?php foreach ($minimumCriteria as $index => $row): ?><tr><td><?= $index + 1 ?></td><td><strong><?= esc($row[0]) ?></strong></td><td><?= esc($row[1]) ?></td></tr><?php endforeach ?></tbody></table></div><h3 style="margin-top:22px">15 Butir Pemeriksaan Operasional</h3><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>No.</th><th>Parameter</th><th>Unsur Pemeriksaan</th></tr></thead><tbody><?php foreach ($initialChecks as $index => $row): ?><tr><td><?= $index + 1 ?></td><td><?= esc($row[0]) ?></td><td><?= esc($row[1]) ?></td></tr><?php endforeach ?></tbody></table></div><div class="doc-callout"><strong>Prasyarat wajib.</strong> Jurnal yang tidak lolos Pemeriksaan Awal tidak dilanjutkan ke tahap berikutnya.</div></section>

            <section class="doc-section" id="pemeriksaan-kelayakan"><div class="section-heading"><div><h2>Pemeriksaan Kelayakan</h2><p>Menentukan kelayakan jurnal sebelum penilaian A–G.</p></div></div><div class="eligibility-grid"><article class="info-card"><strong>1. Kecukupan Penelaahan Artikel oleh Mitra Bestari</strong><p>Memastikan setiap artikel yang diterbitkan telah melalui penelaahan oleh Mitra Bestari.</p></article><article class="info-card"><strong>2. Validitas dan Integritas Penerbit</strong><p>Memeriksa rekam jejak penerbit serta kepatuhan terhadap etika publikasi, etika penerbitan, dan integritas akademik.</p></article></div><div class="doc-callout info">Keluaran tahap ini adalah <strong>Lolos / Tidak Lolos</strong>, bukan skor Unsur A–G.</div></section>

            <section class="doc-section" id="unsur-bobot"><div class="section-heading"><div><h2>Unsur dan Bobot Penilaian</h2><p>Komposisi maksimum penilaian Tata Kelola dan Mutu Artikel.</p></div></div><div class="score-summary"><div class="summary-card"><span>Tata Kelola</span><strong>46 poin</strong></div><div class="summary-card"><span>Mutu Artikel</span><strong>54 poin</strong></div><div class="summary-card total"><span>Total</span><strong>100 poin</strong></div></div><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>Kode</th><th>Unsur Penilaian</th><th>Tata Kelola</th><th>Mutu Artikel</th></tr></thead><tbody><?php foreach ($categories as $code => $category): ?><tr><td><strong><?= $code ?></strong></td><td><?= esc($category['label']) ?></td><td class="numeric"><?= $category['group'] === 'Tata Kelola' ? $formatNumber($category['max']) : '—' ?></td><td class="numeric"><?= $category['group'] === 'Mutu Artikel' ? $formatNumber($category['max']) : '—' ?></td></tr><?php endforeach ?><tr><td></td><td><strong>Jumlah</strong></td><td class="numeric"><strong>46</strong></td><td class="numeric"><strong>54</strong></td></tr></tbody></table></div></section>

            <div class="standard-banner"><div><span>Standar Penilaian</span><h2>Standar Tata Kelola · Unsur A–E</h2></div><strong>46 Poin</strong></div>
            <?php foreach ($categories as $categoryCode => $category): ?>
                <?php if ($categoryCode === 'F'): ?><div class="standard-banner quality"><div><span>Standar Penilaian</span><h2>Standar Mutu Artikel · Unsur F–G</h2></div><strong>54 Poin</strong></div><?php endif ?>
                <section class="doc-section" id="unsur-<?= strtolower($categoryCode) ?>"><div class="section-heading"><div class="heading-copy"><span class="section-code"><?= $categoryCode ?></span><div><h2><?= esc($category['label']) ?></h2><p><?= esc($category['group']) ?></p></div></div><span class="max-badge">Maksimum <?= $formatNumber($category['max']) ?> poin</span></div>
                    <?php foreach ($rubricItems as $itemCode => $item): ?><?php if (substr($itemCode, 0, 1) !== $categoryCode) continue; ?>
                        <article class="subrubric"><div class="subrubric-head"><h3><?= esc($itemCode) ?> · <?= esc($item['label']) ?></h3><span class="subrubric-score">Maks. <?= $formatNumber($item['max']) ?></span></div>
                            <?php if (isset($componentNotes[$itemCode])): ?><ol class="component-list"><?php foreach ($componentNotes[$itemCode] as $component): ?><li><?= esc($component) ?></li><?php endforeach ?></ol><?php endif ?>
                            <div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>Nilai</th><th>Indikator</th></tr></thead><tbody><?php foreach ($item['options'] as [$score, $indicator]): ?><tr><td class="numeric"><?= $formatNumber($score) ?></td><td><?= esc($indicator) ?></td></tr><?php endforeach ?></tbody></table></div>
                            <?php if (isset($officialExplanations[$itemCode])): ?>
                                <div class="official-explanation">
                                    <div class="official-explanation__head">
                                        <div class="official-explanation__title"><span class="official-explanation__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M6 3h9l3 3v15H6z"/><path d="M15 3v4h4M9 11h6M9 15h6"/></svg></span>Penjelasan Berdasarkan Juknis</div>
                                        <span class="official-explanation__source">Materi lampiran Penjelasan Unsur A–G 2026</span>
                                    </div>
                                    <ol><?php foreach ($officialExplanations[$itemCode]['points'] as $point): ?><li><?= esc($point) ?></li><?php endforeach ?></ol>
                                </div>
                            <?php endif ?>
                            <?php if (isset($managementNotes[$itemCode])): ?><div class="management-notes"><h4>Yang Perlu Diperhatikan Pengelola</h4><ul><?php foreach ($managementNotes[$itemCode] as $note): ?><li><?= esc($note) ?></li><?php endforeach ?></ul></div><?php endif ?>
                        </article>
                    <?php endforeach ?>
                </section>
            <?php endforeach ?>

            <section class="doc-section warning-section" id="disinsentif"><div class="section-heading"><div><h2>Disinsentif</h2><p>Pengurangan nilai di luar total maksimum 100 poin.</p></div></div><div class="warning-grid"><article class="warning-card"><h3>H.1 Pelanggaran Integritas Akademik</h3><p>Meliputi fabrikasi, falsifikasi, plagiat, kepengarangan tidak sah, konflik kepentingan, pengajuan jamak, dan pelanggaran integritas akademik lainnya.</p><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>Temuan</th><th>Pengurangan</th></tr></thead><tbody><tr><td>&gt;3 artikel melanggar tanpa koreksi/retraksi</td><td class="numeric">−20</td></tr><tr><td>2–3 artikel melanggar tanpa koreksi/retraksi</td><td class="numeric">−15</td></tr><tr><td>1 artikel melanggar tanpa koreksi/retraksi</td><td class="numeric">−10</td></tr></tbody></table></div></article><article class="warning-card"><h3>H.2 Ethical Clearance</h3><p>Informasi Ethical Clearance atau pernyataan kepatuhan etik yang dipersyaratkan tidak tersedia.</p><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>Kondisi</th><th>Pengurangan</th></tr></thead><tbody><tr><td>Ketidaktersediaan Ethical Clearance sesuai ketentuan</td><td class="numeric">−3</td></tr></tbody></table></div></article></div></section>

            <section class="doc-section" id="peringkat"><div class="section-heading"><div><h2>Peringkat Akreditasi</h2><p>Status berdasarkan nilai total setelah memperhitungkan disinsentif.</p></div></div><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>Rentang Nilai</th><th>Status</th></tr></thead><tbody><tr><td class="numeric">90 ≤ n ≤ 100</td><td><strong>Terakreditasi Peringkat 1</strong></td></tr><tr><td class="numeric">80 ≤ n &lt; 90</td><td><strong>Terakreditasi Peringkat 2</strong></td></tr><tr><td class="numeric">70 ≤ n &lt; 80</td><td><strong>Terakreditasi Peringkat 3</strong></td></tr><tr><td class="numeric">60 ≤ n &lt; 70</td><td><strong>Terakreditasi Peringkat 4</strong></td></tr><tr><td class="numeric">n &lt; 60</td><td><strong>Tidak Terakreditasi</strong></td></tr></tbody></table></div></section>

            <section class="doc-section" id="ketentuan-penting"><div class="section-heading"><div><h2>Ketentuan Penting bagi Pengelola</h2><p>Praktik pengelolaan yang wajib diperhatikan.</p></div></div><ul class="checklist"><?php foreach ($importantRules as $rule): ?><li><?= esc($rule) ?></li><?php endforeach ?></ul></section>

            <section class="doc-section" id="pengajuan"><div class="section-heading"><div><h2>Pengajuan Akreditasi</h2><p>Akreditasi baru, ulang, pengajuan kembali, dan tata cara melalui ARJUNA.</p></div></div><div class="submission-grid"><article class="submission-card"><h3>Akreditasi Baru</h3><ul><li>Belum pernah terakreditasi atau diperlakukan sebagai Akreditasi Baru.</li><li>Terbit berkala sekurang-kurangnya 3 tahun.</li><li>Mengajukan seluruh nomor terbitan 3 tahun terakhir.</li></ul></article><article class="submission-card"><h3>Akreditasi Ulang</h3><ul><li>Sebelum berakhir: paling cepat setelah 3 nomor terbaru dan paling lambat 6 bulan sebelum berakhir.</li><li>Setelah berakhir: maksimal 2 tahun; selebihnya menjadi Akreditasi Baru.</li></ul></article><article class="submission-card"><h3>Tata Cara melalui ARJUNA</h3><ol><li>Isi, mutakhirkan, dan verifikasi borang.</li><li>Masukkan seluruh nomor dan tautan akses.</li><li>Pastikan PDF dapat diakses.</li><li>Sediakan akun Editor valid.</li><li>Tekan <strong>Siap Akreditasi</strong>.</li></ol></article></div><h3 style="margin-top:20px">Ketentuan Pengajuan Kembali</h3><div class="docs-table-wrap"><table class="docs-table"><thead><tr><th>Kondisi</th><th>Waktu Pengajuan</th></tr></thead><tbody><tr><td>Tidak lolos Pemeriksaan Awal</td><td>Periode berikutnya, dengan pengecualian tertentu terkait frekuensi/keberkalaan.</td></tr><tr><td>Tidak lolos Pemeriksaan Kelayakan</td><td>Paling cepat 2 tahun.</td></tr><tr><td>Nilai &lt;60 tanpa disinsentif</td><td>Setelah minimal 3 nomor terbitan baru.</td></tr><tr><td>Nilai &lt;60 setelah disinsentif</td><td>Paling cepat 3 tahun.</td></tr><tr><td>Penurunan peringkat</td><td>Paling cepat 3 tahun.</td></tr><tr><td>Pembekuan status</td><td>Paling cepat 4 tahun.</td></tr><tr><td>Pencabutan status</td><td>Paling cepat 5 tahun.</td></tr></tbody></table></div></section>

            <section class="doc-section" id="masa-berlaku"><div class="section-heading"><div><h2>Masa Berlaku</h2><p>Ketentuan pencantuman hasil akreditasi pada laman jurnal.</p></div><span class="max-badge">5 Tahun</span></div><div class="score-summary"><div class="summary-card total"><span>Masa berlaku hasil akreditasi</span><strong>5 tahun</strong></div><div class="summary-card"><span>Wajib dicantumkan</span><strong>Peringkat</strong></div><div class="summary-card"><span>Informasi masa berlaku</span><strong>Nomor & tanggal</strong></div></div><p>Peringkat dan masa berlaku wajib dicantumkan pada laman jurnal. Informasi sekurang-kurangnya memuat nomor dan tanggal penetapan serta tanggal akhir masa berlaku.</p><div class="doc-callout info"><strong>Penting:</strong> aplikasi ini merupakan alat simulasi dan evaluasi diri. Skor, status kelulusan, dan prediksi peringkat tidak menggantikan pemeriksaan asesor, verifikasi Tim Akreditasi, harmonisasi hasil, maupun keputusan resmi Direktur Jenderal.</div></section>
        </main>
    </div>
    <a class="back-top" href="#top" aria-label="Kembali ke atas"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 15 6-6 6 6"/></svg></a>
</div>
<script>
const docLinks=[...document.querySelectorAll('.docs-toc a')];
const docSections=[...document.querySelectorAll('.doc-section[id]')];
if('IntersectionObserver' in window){
    const observer=new IntersectionObserver(entries=>{entries.forEach(entry=>{if(entry.isIntersecting){docLinks.forEach(link=>link.classList.toggle('active',link.getAttribute('href')==='#'+entry.target.id));}});},{rootMargin:'-15% 0px -70% 0px'});
    docSections.forEach(section=>observer.observe(section));
}
</script>
<?= $this->endSection() ?>
