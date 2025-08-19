<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="320" alt="Laravel Logo">
</p>

<h1 align="center">KTA Badan Usaha - Modern Membership & Management System</h1>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=flat-square" alt="Laravel Version">
  <img src="https://img.shields.io/badge/Bootstrap-5-blue?style=flat-square" alt="Bootstrap Version">
  <img src="https://img.shields.io/badge/Modern%20UI-Yes-success?style=flat-square" alt="Modern UI">
  <img src="https://img.shields.io/badge/Role%20Based%20Access-Admin%2C%20Staff%2C%20PJ-orange?style=flat-square" alt="Role Based">
</p>

---

## 🚀 Overview
KTA Badan Usaha adalah sistem keanggotaan modern berbasis Laravel untuk pengelolaan data badan usaha, pembayaran, verifikasi, dan pembuatan KTA digital dengan QR code. Dirancang dengan UI stylish, animasi, dan fitur interaktif untuk pengalaman pengguna terbaik.

---

## ✨ Fitur Unggulan
- **Login & Register** dengan validasi modern
- **Role-based Dashboard**: Admin, Staff, PJ (Penanggung Jawab)
- **CRUD Badan Usaha** dengan filter, pencarian, dan pagination stylish
- **Pembayaran & Invoice**: Upload bukti, verifikasi admin/staff, riwayat transaksi
- **KTA Digital**: Sertifikat digital dengan QR code, logo, masa berlaku
- **Settings Akun**: Update data user, ganti password, role management
- **History Transaksi**: Admin/staff dapat melihat semua riwayat pembayaran
- **UI/UX Modern**: Bootstrap 5, animasi, card, gradient, icon, responsive

---

## 🛠️ Teknologi
- **Laravel 12.x**
- **Bootstrap 5** & Bootstrap Icons
- **SweetAlert2** untuk notifikasi
- **simplesoftwareio/simple-qrcode** untuk QR code
- **Blade Templating**
- **SQLite** (default, bisa diganti MySQL/PostgreSQL)

---

## 📸 Demo Visual
<p align="center">
  <img src="https://i.imgur.com/2QZb6bA.png" width="600" alt="Dashboard Demo">
  <br>
  <img src="https://i.imgur.com/8QZb6bA.png" width="600" alt="KTA Digital Demo">
</p>

---

## ⚡ Instalasi & Setup
1. **Clone repository**
   ```bash
   git clone https://github.com/JonathanZefanya/kta-badan-usaha.git
   cd kta-badan-usaha/kta-badan-usaha
   ```
2. **Install dependencies**
   ```bash
   composer install
   ```
3. **Konfigurasi environment**
   - Copy `.env.example` ke `.env`
   - Atur database (default: SQLite)
   - Jalankan `php artisan key:generate`
4. **Migrasi & Seed database**
   ```bash
   php artisan migrate --seed
   ```
5. **Jalankan server**
   ```bash
   php artisan serve
   ```

---

## 🧑‍💻 Struktur Folder
- `app/Http/Controllers` - Semua logic controller
- `app/Models` - Model Eloquent
- `resources/views` - Blade templates
- `routes/web.php` - Routing utama
- `database/migrations` - Struktur tabel
- `database/seeders` - Seeder data awal

---

## 🔒 Role & Hak Akses
- **Admin**: Kelola user, verifikasi pembayaran, kelola settings website
- **Staff**: Verifikasi pembayaran, kelola history transaksi
- **PJ**: Input data badan usaha, upload pembayaran, cetak KTA

---

## ❤️ Kontribusi
Pull request, issue, dan saran sangat diterima! Ikuti [Code of Conduct Laravel](https://laravel.com/docs/contributions#code-of-conduct).

---

## 📧 Kontak & Dukungan
- Email: jonathanzefanya16@gmail.com

---

## 📜 Lisensi
Open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
