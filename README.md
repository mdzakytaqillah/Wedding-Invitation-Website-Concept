# Digital Wedding Invitation Website Concept

Website ini adalah platform undangan pernikahan digital berbasis web yang dirancang untuk memberikan pengalaman personal bagi para tamu serta kemudahan pengelolaan data bagi penyelenggara acara. Proyek ini dikembangkan menggunakan arsitektur **MVC (Model-View-Controller)** dengan PHP murni untuk memastikan kode yang terstruktur dan mudah dikelola.

## 📌 Fitur Utama

### 1. Panel Kelola (Admin Console)
* **Manajemen Admin**: Admin yang terdaftar sebagai pengelola dapat mengelola data acara sepenuhnya dan dapat membuat akun pengundang untuk pihak yang ikut serta mengundang tamu.
* **Manajemen Tamu**: Pendaftaran tamu undangan beserta grup tamu dengan kode unik yang dapat ditetapkan atau dibuat otomatis oleh sistem untuk setiap personal tamu.
* **Pengelolaan Media**: Mengelola komentar tamu, cover undangan, galeri, video YouTube, dan media sharing dengan validasi ukuran dan format file yang diupload.
* **Integrasi YouTube**: Fitur semat video YouTube dengan sistem ekstraksi Video ID dari link YouTube standar dan shortlink YouTube untuk diterapkan dalam bentuk embed video secara otomatis.
* **Media Sharing Terkontrol**: Berbagi folder Google Drive dengan sistem hak akses yang spesifik per tamu atau per grup.

### 2. Konten Undangan
* **Profil Mempelai**: (COMING SOON) Informasi lengkap meliputi nama panggilan, nama lengkap, foto, akun Instagram, hingga nama orang tua.
* **Detail Acara**: Informasi tanggal, jam, zona waktu (WIB/WITA/WIT), dan lokasi untuk prosesi akad dan resepsi.
* **Media**: Menampilkan video YouTube dan galeri foto dari mempelai.
* **Love Story**: Fitur cerita perjalanan cinta dinamis dari mempelai.
* **Digital Envelope**: Penyediaan nomor rekening/e-wallet untuk kado digital.
* **Ucapan & Doa**: Fitur untuk mengirim ucapan dan doa, disertai pilihan untuk mempublikasikan atau private.

### 3. Pengalaman Tamu (Guest Experience)
* **Undangan Personal**: Sistem pengenalan tamu berdasarkan ID unik sehingga setiap tamu mendapatkan undangan yang dipersonalisasi.
* **Akses Media Terbatas**: Tamu hanya akan melihat folder media sharing yang diizinkan oleh admin.

## Pertimbangan Masa Depan
Fitur-fitur yang telah dipertimbangkan untuk dikembangkan dan diimplementasikan
* **Private Event**: Admnin dapat menetapkan undangan sebagai undangan privat yang hanya dapat diakses oleh tamu yang terdata dan memiliki kode unik rahasia atau undangan umum yang dapat diakses oleh seluruh tamu tanpa perlu pendataan seluruh tamu.
* **Customize Event per Grup Tamu**: Admin dapat menetapkan grup tamu yang diundang untuk acara Akad Nikah serta Resepsi atau hanya acara Resepsi saja.
* **Custom Broadcast Message**: Membuat pesan broadcast yang dapat disesuaikan dan digunakan untuk menyebarkan pesan undangan kepada tamu.
* **Pendataan Kehadiran Tamu**: Fitur untuk mendata tamu yang hadir melalui scan QR ataupun input manual nama tamu (Jika pengaturan undangan dibuat umum).

## 🛠️ Teknologi yang Digunakan

* **Bahasa Pemrograman**: PHP
* **Struktur Program**: [MVC dengan PHP](https://github.com/sandhikagalih/phpmvc) milik [Sandhika Galih](https://github.com/sandhikagalih)
* **Database**: MySQL
* **Frontend**: Bootstrap dan Tailwind CSS (untuk view utama)
* **Library Tambahan**: SweetAlert2 (Notifikasi) dan jQuery (Helper validasi)

## 📂 Struktur Folder

```text
.
├── app/
│   ├── config/         # Konfigurasi database dan URL
│   ├── controllers/    # Logika alur aplikasi
│   ├── core/           # Inti fungsi program (App, Controller, Database)
│   ├── models/         # Interaksi data ke database
│   └── views/          # Tampilan antarmuka pengguna
├── css/                # File akses publik (CSS)
├── img/                # File akses publik (Images)
└── index.php           # Entry point aplikasi
```

## ⚖️ Lisensi dan Ketentuan Penggunaan

Proyek ini dikembangkan secara terbuka (*open-source*), namun dengan batasan hukum sebagai berikut:

* **Dilarang Komersialisasi:** Kode sumber dan desain dalam proyek ini tidak boleh diperjualbelikan atau digunakan untuk menghasilkan keuntungan finansial tanpa izin tertulis dari pemilik.
* **Hak Cipta Tetap Dilindungi:** Seluruh kode tetap menjadi hak milik intelektual pengembang asli. Dilarang keras mengklaim kepemilikan atau menghapus atribusi penulis.
* **Penggunaan Personal/Edukasi:** Sangat diperbolehkan dan didukung.

Lisensi penuh: [CC BY-NC 4.0](LICENSE)
