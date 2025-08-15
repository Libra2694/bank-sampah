# 🏦 Bank Sampah - Sistem Manajemen Sampah Digital  
*Aplikasi berbasis web untuk mengelola transaksi, penjemputan, dan data nasabah/petugas bank sampah.*

![Dashboard Bank Sampah](https://res.cloudinary.com/dzgxqfnv9/image/upload/v1755271824/imgtourl/Screenshot_2025-08-15_220352_fiyv8c.png)

---

## 🔍 Deskripsi Proyek  
Aplikasi ini membantu:  
- **Nasabah**: Menyetor sampah, melihat riwayat transaksi, dan menjadwalkan penjemputan  
- **Petugas**: Mencatat transaksi, mengelola jadwal penjemputan, dan memantau statistik  

---

## 📂 Menu Sidebar  
| Menu | Deskripsi |  
|------|-----------|  
| **Dashboard** | Statistik harian (nasabah, transaksi, sampah terdaftar) |  
| **Jenis Sampah** | Daftar kategori sampah (plastik, kertas, logam) beserta harga |  
| **Transaksi** | Catatan setoran sampah oleh nasabah |  
| **Penjemputan** | Jadwal pengambilan sampah oleh petugas |  
| **Data Nasabah** | Informasi anggota bank sampah |  
| **Data Petugas** | Manajemen akun petugas |  

---

## 🚀 Panduan Instalasi  

### ✅ Persyaratan  
- Git  
- PHP 8.0+ & Composer *(untuk backend Laravel)*  
- Node.js 16+ & npm *(untuk frontend JavaScript)*  
- MySQL/MariaDB  

### 🔧 Langkah-langkah Instalasi  

#### 1. Clone Repository
```bash
git clone https://github.com/username-anda/bank-sampah.git
cd bank-sampah
```
2. Instal Dependencies
- Backend (PHP/Laravel):
```bash
composer install
cp .env.example .env
php artisan key:generate
```
- Frontend (JavaScript/React/Vue):
```bash
npm install
npm run dev
```
3. Setup Database
- Buat database baru di MySQL: bank-sampah
- Import database bank-sampah.sql ke MySQL.
CLI: 
- Buat database baru di MySQL:
```bash
mysql -u root -p -e "CREATE DATABASE bank_sampah;"
```
- Import file SQL:
```bash
mysql -u root -p bank_sampah < database/bank-sampah.sql
```
Konfigurasi .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bank_sampah
DB_USERNAME=root
DB_PASSWORD=
```
4. Jalankan Aplikasi
```bash
php artisan serve
npm run dev
```
Akses di: http://localhost:8000 
Login Awal
| email                 | password  |
|-----------------------|-----------|
| admin@banksampah.com  | password  |


## 📊 Fitur Utama
- 📈 Statistik real-time nasabah dan transaksi
- 🗓️ Sistem penjadwalan penjemputan sampah
- 📊 Katalog jenis sampah dengan harga
- 👥 Manajemen data nasabah dan petugas

## 🛠 Troubleshooting
Import database gagal? Pastikan:
- File bank-sampah.sql ada di folder database/
- Service MySQL sedang berjalan
- User MySQL memiliki hak akses
Port 8000 sibuk? Ganti di .env:
```bash
APP_PORT=8080
```
---

## 📄 Lisensi

Proyek ini dirilis di bawah lisensi [MIT License](LICENSE).  
Kamu bebas menggunakan, menyalin, memodifikasi, dan mendistribusikan proyek ini selama menyertakan copyright.

Semoga membantu! 😊

MIT License - © 2025 Libra

![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)

---

## ✉️ Kontak

Jika Anda memiliki pertanyaan, saran, atau ingin berkontribusi pada proyek ini, silakan hubungi saya melalui:

- 📧 Email: [Libra](mailto:libraproject26@gmail.com)
- 💬 Telegram: [Libra](https://t.me/libra_id26)