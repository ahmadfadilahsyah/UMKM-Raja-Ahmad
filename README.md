# 🛒 Website UMKM Raja Ahmad

Sistem manajemen UMKM berbasis web untuk **Raja Ahmad** – memudahkan pengelolaan produk, staf, transaksi barang masuk, dan laporan penjualan. Dibangun dengan **PHP MySQLi**, **Bootstrap 5**, dan **DataTables** + **Chart.js**.

## ✨ Fitur Utama

- ✅ **Multi-user role** (Admin, Pemilik, Staf)
- ✅ **Login dengan CAPTCHA** (keamanan tambahan)
- ✅ **CRUD Produk** (nama, harga, stok, upload gambar)
- ✅ **CRUD Staf** (khusus Admin/Pemilik)
- ✅ **Transaksi Barang Masuk** – keranjang belanja + update stok otomatis
- ✅ **Dashboard** dengan grafik pembelian per bulan (Chart.js)
- ✅ **Laporan transaksi** (filter bulan/tahun)
- ✅ **Halaman depan publik** (katalog produk, carousel, kategori, pencarian)
- ✅ **Responsif** (mobile friendly dengan Bootstrap 5)

## 🖥️ Teknologi yang Digunakan

- PHP 7.4+ (dengan ekstensi **GD** untuk CAPTCHA)
- MySQL / MariaDB
- Bootstrap 5 (CSS framework)
- jQuery, DataTables, Chart.js
- FontAwesome (ikon)


## 🗄️ Instalasi

### 1. Prasyarat
- XAMPP / Laragon / MAMP (PHP & MySQL)
- Ekstensi PHP **GD** aktif (untuk CAPTCHA)

### 2. Langkah-langkah

**a. Clone atau download** project ke dalam folder `htdocs` (misal `C:\xampp\htdocs\project\raja_ahmad`)

**b. Buat database**  
- Buka phpMyAdmin
- Buat database baru: `umkm_raja_ahmad`
- Import file SQL yang sudah disediakan (atau jalankan query di bawah)

**c. Konfigurasi database**  
Edit file `config/database.php` – sesuaikan username, password, nama database jika berbeda.

**d. Aktifkan ekstensi GD**  
- Buka `php.ini` (di folder PHP XAMPP)
- Cari `;extension=gd` – hapus titik koma menjadi `extension=gd`
- Restart Apache

**e. Buat folder uploads**  
- Buat folder `assets/uploads/` dan beri izin tulis (777 di Linux / Allow di Windows)

**f. Akses website**  
- Buka browser: `http://localhost/project/raja_ahmad/index.php`

## 🔐 Akun Default

| Role      | Username | Password |
|-----------|----------|----------|
| Admin     | `admin`  | `raja123`|
| Pemilik   | `pemilik`| `raja123`|
| Staf      | `staf`   | `raja123`|

> **Catatan:** Pastikan menjalankan file `update_hash.php` sekali (letakkan di root, akses via browser) untuk mengubah password menjadi hash yang benar. Setelah sukses, hapus file tersebut.

## 🧪 Cara Menggunakan

1. **Login** dengan akun di atas.
2. **Dashboard** – melihat total produk & staf, grafik pembelian bulanan.
3. **Produk** – tambah, edit, hapus produk, upload gambar.
4. **Staf** (hanya Admin/Pemilik) – kelola akun staf.
5. **Barang Masuk** – tambah produk ke keranjang, simpan transaksi, stok otomatis bertambah.
6. **Laporan** – filter transaksi per bulan/tahun.
7. **Beranda** (tanpa login) – melihat katalog produk dan banner promosi.

## 🎨 Kustomisasi Tampilan

- **Warna tema** – ubah di `index.php` (bagian `<style>`), variabel `#b87c2e` dan `#8B5A2B`.
- **Navbar & modal login** – edit `header.php`.
- **Footer** – edit `footer.php`.
- **Halaman depan** – edit `public/index.php` (carousel, kategori, grid produk).

## 🛠️ Troubleshooting

### ❌ CAPTCHA tidak tampil
- Pastikan ekstensi **GD** aktif di `php.ini` dan Apache sudah direstart.

### ❌ Login gagal (password salah)
- Jalankan `update_hash.php` untuk mengupdate password semua akun menjadi `raja123` (hash).
- Atau update manual lewat phpMyAdmin:  
  `UPDATE staff SET password = '$2y$10$...' WHERE username='admin';`

### ❌ Gambar produk tidak muncul
- Pastikan file gambar ada di folder `assets/uploads/`
- Nama file gambar di database harus sesuai (case-sensitive)

### ❌ Error "include(admin/transaksi.php): failed to open stream"
- Pastikan nama file di menu `transaksi_masuk.php` bukan `transaksi.php`.  
- Cek parameter `?menu=` di URL – harus `?menu=transaksi_masuk`.

## 📄 Lisensi

Dibuat untuk keperluan tugas / pembelajaran. Bebas digunakan dan dikembangkan.

## 🙏 Kontribusi

Jika menemukan bug atau ingin menambah fitur, silakan buka issue atau pull request.

---

**Selamat menggunakan UMKM Raja Ahmad!**  
_Dikembangkan dengan ❤️ untuk kemajuan UMKM Indonesia._
