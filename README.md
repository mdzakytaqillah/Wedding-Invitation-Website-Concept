# Digital Wedding Invitation Website Concept

Platform undangan pernikahan digital berbasis web (*full-stack*) yang dirancang untuk menghadirkan pengalaman undangan yang terpersonalisasi bagi setiap tamu sekaligus menyediakan sistem manajemen acara, tamu, moderasi ucapan, dan distribusi dokumentasi yang aman bagi penyelenggara. Proyek ini dikembangkan menggunakan arsitektur **MVC (*Model-View-Controller*)** dengan PHP murni (*Native*) dan basis data relasional **MySQL (PDO)**.

---

## Fitur Utama

### 1. Panel Kelola Berbasis Peran (Role-Based Admin Console)
* **Manajemen Multi-Akses (`roleRank`):**
  * **Pengelola Utama (*Admin*):** Memiliki akses penuh untuk mengelola data mempelai & acara, konfigurasi media, moderasi ucapan tamu, serta mendaftarkan akun baru baik sebagai sesama **Turut Mengelola** maupun **Turut Mengundang**.
  * **Akun Pengundang (*Inviter*):** Memungkinkan pihak keluarga atau kerabat ikut mengelola grup tamu dan mendaftarkan tamu undangan mereka sendiri dengan pembatasan hak akses kepemilikan data (`addBy`) agar tidak saling mengubah data tamu pihak lain.
* **Manajemen Tamu & Generator Kode Unik Otomatis:**
  * Mendukung pencatatan gelar depan (*Prefix* seperti Bapak, Ibu, Saudara/i, Tuan, Nyonya) dan gelar belakang (*Suffix* akademik/profesi).
  * **Auto-Generated Guest Code:** Jika kode unik tamu dikosongkan atau terdeteksi duplikat, sistem secara otomatis membangkitkan kode unik berbasis **inisial nama tamu + 4 digit *hash* MD5 acak** (contoh: `MDT-8A3F`).
  * **Pencarian & Filter Multi-Kriteria:** Menyaring daftar tamu berdasarkan kata kunci nama/kode unik, grup tamu, maupun akun penginput (*"Hanya Inputan Saya"*).
  * **Proteksi Penghapusan Grup (*Anti-Accidental Delete*):** Menghapus grup tamu mewajibkan pengguna mengetik ulang frase konfirmasi `HAPUS GRUP [NAMA GRUP] SEKARANG` secara manual dengan pemblokiran fitur *copy-paste* dan klik kanan.
* **Pengelolaan Media & Validasi File:**
  * Mengelola *Hero Cover*, *Masonry Photo Gallery* (mendukung *multi-slot* dan *multiple file upload*), sematan video YouTube, dan tautan dokumentasi Google Drive.
  * Validasi berlapis (sisi klien & server) untuk membatasi format gambar (`.jpg`, `.jpeg`, `.png`) dan ukuran maksimal **4 MB**, disertai fitur pembersihan file lama otomatis di server (`unlink`) saat foto diganti atau dihapus.
* **Integrasi Regex YouTube & Google Maps:**
  * Mengekstrak 11 karakter *YouTube Video ID* secara otomatis baik dari tautan standar (`youtube.com/watch?v=...`) maupun tautan pendek (`youtu.be/...`) serta memvalidasi keabsahan tautan lokasi Google Maps.
* **Media Sharing Terkontrol (Granular Access Control):**
  * Berbagi tautan folder dokumentasi Google Drive dengan pengaturan hak akses **Publik (Semua Tamu)** atau **Terbatas** khusus untuk **Grup Tamu tertentu** dan/atau **Individu Tamu tertentu** melalui tabel relasi `canaccess`.

### 2. Konten & Antarmuka Undangan
* **Splash Screen Terpersonalisasi:** Menyapa tamu secara spesifik lengkap dengan gelar depan, nama lengkap, dan gelar belakang berdasarkan kode unik pada URL, serta menyimpan status buka undangan di `sessionStorage` peramban.
* **Countdown Timer Lintas Zona Waktu (ISO-8601):** Hitung mundur waktu acara secara *real-time* yang secara otomatis menyesuaikan *offset* zona waktu Indonesia (**WIB `+07:00`**, **WITA `+08:00`**, dan **WIT `+09:00`**).
* **Profil Mempelai & Detail Acara Adaptif:** Menampilkan foto, nama lengkap, nama orang tua, tautan Instagram, serta informasi Akad Nikah dan Resepsi yang otomatis menyembunyikan bagian terkait apabila data belum diisi oleh pengelola.
* **Dynamic Love Story & Digital Envelope:**
  * Linimasa perjalanan cinta (*Love Story*) dan daftar rekening kado digital (*Digital Envelope*) yang dapat ditambah atau dihapus barisnya secara dinamis.
  * Mendukung pencocokan logo otomatis untuk **9 Bank** (BCA, Mandiri, BNI, BRI, BSI, BTN, DBS, Bank Jago, SeaBank) dan **4 E-Wallet** (GoPay, Dana, LinkAja, ShopeePay) lengkap dengan sanitasi karakter non-angka dan tombol *Salin Nomor Rekening* sekali klik.
* **Sistem Ucapan, 3 Mode Privasi, & Moderasi (*Wall of Love*):**
  * Tamu dapat memilih 3 opsi privasi saat mengirim doa: **Hanya untuk pengelola (Privat)**, **Publikasikan dengan nama samaran (Anonim)**, atau **Publikasikan beserta nama & asal grup**.
  * Setiap ucapan publik yang masuk akan ditampung pada antrean **Menunggu Persetujuan** di *Admin Console* untuk disetujui (*Approve*) atau ditolak (*Reject*) oleh pengelola sebelum tampil pada *slider Wall of Love*.

---

## Pertimbangan Pengembangan Masa Depan

Fitur-fitur yang telah dirancang untuk iterasi pengembangan selanjutnya:
* **Private Event Mode:** Pengaturan untuk mengunci undangan agar hanya dapat dibuka oleh tamu terdaftar yang memiliki kode unik rahasia.
* **Kustomisasi Sesi Acara per Grup Tamu:** Mengatur visibilitas detail acara (Akad Nikah & Resepsi atau Resepsi saja) secara spesifik berdasarkan grup tamu.
* **Custom Broadcast Message Generator:** Pembuatan templat pesan pengantar WhatsApp/media sosial otomatis yang menyertakan nama tamu dan tautan undangan personal.
* **Sistem Buku Tamu & Presensi Kehadiran:** Pencatatan kehadiran tamu di lokasi acara melalui pemindaian *QR Code* maupun input manual.

---

## Tech Stack

* **Bahasa Pemrograman:** PHP (Native), JavaScript (Vanilla ES6+), HTML5, CSS3
* **Arsitektur Program:** MVC (*Model-View-Controller*) dengan PHP (diadaptasi dan dikembangkan dari konsep dasar [phpmvc](https://github.com/sandhikagalih/phpmvc) oleh [Sandhika Galih](https://github.com/sandhikagalih))
* **Basis Data:** MySQL (menggunakan ekstensi PDO dengan *Prepared Statements* & *Persistent Connection*)
* **Kerangka Kerja Frontend:** Tailwind CSS (Halaman Utama Undangan) & Bootstrap 5.3.3 (Halaman *Admin Console*)
* **Pustaka & Aset UI:** SweetAlert2 (Notifikasi *Pop-up* Interaktif), Swiper.js, Bootstrap Icons, & Google Material Symbols

---

## Struktur Folder

```text
Wedding-Invitation-Website-Concept/
├── app/
│   ├── config/         # Konfigurasi BASEURL dan kredensial database MySQL (invdb)
│   ├── controllers/    # Pengatur alur logika publik (Home.php) dan panel admin (Console.php)
│   ├── core/           # Inti sistem MVC (App, Controller, Database PDO, Flasher, Helper)
│   ├── models/         # Interaksi database (akun_model, event_model, guest_model, media_model, message_model)
│   ├── views/          # Antarmuka pengguna (home, console, media, tamu, frame header/footer)
│   └── init.php        # Bootstrapper komponen inti aplikasi
├── css/                # Stylesheet kustom untuk tata letak responsif Console
├── img/                # Aset publik (logo bank, logo e-wallet, dan penyimpanan foto galeri/cover)
├── index.php           # Entry point utama aplikasi
└── LICENSE             # Lisensi Creative Commons Attribution-NonCommercial 4.0
```

---

## Lisensi dan Ketentuan Penggunaan

Proyek ini dikembangkan secara terbuka (*open-source*) di bawah lisensi **[Creative Commons Attribution-NonCommercial 4.0 International (CC BY-NC 4.0)](LICENSE)**:
* **Dilarang Komersialisasi:** Kode sumber dan desain dalam proyek ini tidak boleh diperjualbelikan atau digunakan untuk tujuan keuntungan finansial tanpa izin tertulis dari pemilik.
* **Atribusi & Hak Cipta:** Seluruh kode tetap menjadi hak milik intelektual pengembang asli (Muhammad Dzaky Taqillah). Dilarang mengklaim kepemilikan atau menghapus atribusi penulis.
* **Penggunaan Personal/Edukasi:** Sangat diperbolehkan dan didukung.