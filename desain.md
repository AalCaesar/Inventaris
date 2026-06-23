# DESAIN SISTEM INVENTARIS

> Dokumen Desain Aplikasi Manajemen Inventaris Barang
> 
> **Versi:** 1.0  
> **Tanggal:** 22 Juni 2026  
> **Framework:** Laravel 11.x  
> **Database:** MySQL

---

## 📋 RINGKASAN PROYEK

Sistem Inventaris adalah aplikasi web berbasis Laravel untuk mengelola data kategori dan barang inventaris. Aplikasi ini memungkinkan pengguna untuk melakukan operasi CRUD (Create, Read, Update, Delete) pada kategori dan item barang, mengelola stok, dan memonitor inventaris perusahaan.

### Tujuan Utama
- Mengelola data kategori barang secara terstruktur
- Mengelola data barang dengan informasi lengkap (kode, nama, stok, harga)
- Memonitor stok barang secara real-time
- Menyediakan laporan inventaris

### Target Pengguna
- Admin sistem (full access)
- Staff gudang (input dan update data)
- Manager (view dan laporan)

---

## 🎯 DAFTAR FITUR

### Modul 1: Manajemen Kategori
- **List Kategori**: Tampilkan semua kategori dalam tabel dengan pagination
- **Tambah Kategori**: Form untuk menambah kategori baru
- **Edit Kategori**: Form untuk mengubah nama kategori
- **Hapus Kategori**: Hapus kategori (dengan validasi jika masih ada barang)
- **Search Kategori**: Pencarian kategori berdasarkan nama

### Modul 2: Manajemen Barang (Items)
- **List Barang**: Tampilkan semua barang dengan info kategori, stok, harga
- **Tambah Barang**: Form untuk menambah barang baru dengan validasi
- **Edit Barang**: Form untuk mengubah data barang
- **Hapus Barang**: Hapus data barang
- **Search Barang**: Pencarian berdasarkan kode barang, nama, atau kategori
- **Filter Barang**: Filter berdasarkan kategori atau stok
- **Detail Barang**: Halaman detail lengkap barang

### Modul 3: Dashboard
- **Ringkasan Statistik**: Total kategori, total barang, total nilai inventaris
- **Barang Stok Rendah**: List barang dengan stok di bawah threshold
- **Barang Terbaru**: 10 barang yang terakhir ditambahkan
- **Grafik**: Chart kategori dengan jumlah barang

### Modul 4: Laporan (Future Enhancement)
- **Laporan Inventaris**: Export data ke Excel/PDF
- **Laporan Stok**: Laporan barang berdasarkan status stok
- **Laporan Nilai**: Laporan total nilai inventaris per kategori

### Modul 5: Autentikasi
- **Login**: Autentikasi pengguna
- **Logout**: Keluar dari sistem
- **Register** (opsional): Pendaftaran user baru

---

## 🗄️ STRUKTUR DATABASE

### ERD (Entity Relationship Diagram)

```
┌─────────────────┐         ┌──────────────────────┐
│   categories    │         │       items          │
├─────────────────┤         ├──────────────────────┤
│ id (PK)         │────┐    │ id (PK)              │
│ name            │    └───<│ category_id (FK)     │
│ created_at      │         │ item_code (UNIQUE)   │
│ updated_at      │         │ name                 │
└─────────────────┘         │ stock                │
                            │ price                │
                            │ created_at           │
                            │ updated_at           │
                            └──────────────────────┘

Relasi: One Category has Many Items
```

### Tabel: categories

| Kolom      | Tipe Data    | Keterangan                    |
|------------|-------------|-------------------------------|
| id         | BIGINT (PK) | Primary key, auto increment   |
| name       | VARCHAR(255)| Nama kategori                 |
| created_at | TIMESTAMP   | Waktu pembuatan record        |
| updated_at | TIMESTAMP   | Waktu update terakhir         |

**Constraints:**
- `name` wajib diisi (NOT NULL)
- `name` harus unik (UNIQUE) - opsional tergantung kebutuhan

### Tabel: items

| Kolom       | Tipe Data    | Keterangan                    |
|-------------|-------------|-------------------------------|
| id          | BIGINT (PK) | Primary key, auto increment   |
| category_id | BIGINT (FK) | Foreign key ke categories.id  |
| item_code   | VARCHAR(255)| Kode unik barang              |
| name        | VARCHAR(255)| Nama barang                   |
| stock       | INTEGER     | Jumlah stok barang            |
| price       | BIGINT      | Harga satuan barang (Rupiah)  |
| created_at  | TIMESTAMP   | Waktu pembuatan record        |
| updated_at  | TIMESTAMP   | Waktu update terakhir         |

**Constraints:**
- `item_code` harus unik (UNIQUE)
- `category_id` foreign key dengan ON DELETE CASCADE
- `stock` default 0, tidak boleh negatif
- `price` tidak boleh negatif
- Semua field wajib diisi kecuali `stock` (ada default)

### Tabel: users (Laravel default)

Menggunakan tabel users default Laravel untuk autentikasi.

---

## 🎨 SPESIFIKASI UI/UX

### Layout Utama

**Template:** AdminLTE 3 atau Bootstrap 5
- **Sidebar Navigation**: Menu kategori, barang, dashboard, laporan
- **Top Navbar**: User info, logout button
- **Breadcrumb**: Navigasi lokasi halaman
- **Footer**: Copyright info

### Halaman Dashboard

**Komponen:**
1. **Card Statistik** (4 cards dalam 1 row)
   - Total Kategori
   - Total Barang
   - Total Nilai Inventaris (Rp)
   - Barang Stok Rendah

2. **Tabel Barang Stok Rendah**
   - Kolom: Kode, Nama, Kategori, Stok, Aksi
   - Warning badge untuk stok < 10

3. **Chart Kategori** (Bar chart atau Pie chart)
   - Jumlah barang per kategori

### Halaman List Kategori

**Komponen:**
- **Tombol Tambah**: Warna primary, di kanan atas
- **Search Box**: Input search dengan icon
- **Tabel Kategori**:
  - Kolom: No, Nama Kategori, Jumlah Barang, Aksi (Edit, Hapus)
  - Pagination: 10 records per halaman
- **Alert Konfirmasi**: SweetAlert untuk delete

### Halaman Form Kategori (Tambah/Edit)

**Komponen:**
- **Input Nama Kategori**: Required, max 255 karakter
- **Tombol Simpan**: Warna success
- **Tombol Batal**: Warna secondary, kembali ke list

### Halaman List Barang

**Komponen:**
- **Tombol Tambah**: Warna primary
- **Filter & Search Section**:
  - Select kategori (dropdown)
  - Input search (kode/nama barang)
  - Tombol Reset Filter
- **Tabel Barang**:
  - Kolom: No, Kode, Nama, Kategori, Stok, Harga, Aksi
  - Badge untuk stok rendah
  - Format harga: Rp xxx.xxx
  - Aksi: View Detail, Edit, Hapus
  - Pagination: 15 records per halaman

### Halaman Form Barang (Tambah/Edit)

**Komponen:**
- **Input Kode Barang**: Required, unique, readonly saat edit
- **Input Nama Barang**: Required, max 255 karakter
- **Select Kategori**: Dropdown dari tabel categories
- **Input Stok**: Number input, min 0, default 0
- **Input Harga**: Number input, min 0, format Rupiah
- **Tombol Simpan**: Warna success
- **Tombol Batal**: Warna secondary

### Halaman Detail Barang

**Komponen:**
- **Card Info Barang**: Display all fields in read-only format
- **Tombol Edit**: Navigate to edit form
- **Tombol Kembali**: Back to list

---

## 📐 BUSINESS RULES & VALIDASI

### Kategori

**Validasi Input:**
- Nama kategori: Required, string, max 255 karakter
- Nama kategori: Boleh duplikat atau unik (tergantung kebutuhan bisnis)

**Business Rules:**
- Kategori tidak bisa dihapus jika masih ada barang terkait
- Saat edit kategori, otomatis update relasi ke items
- Soft delete opsional untuk audit trail

### Barang

**Validasi Input:**
- Kode barang: Required, unique, string, max 50 karakter, format uppercase
- Nama barang: Required, string, max 255 karakter
- Kategori: Required, must exist in categories table
- Stok: Required, integer, min 0, default 0
- Harga: Required, integer (dalam rupiah), min 0

**Business Rules:**
- Kode barang otomatis generate atau manual input (pilih salah satu)
  - Jika auto: Format `BRG-{YYYY}-{XXXX}` (contoh: BRG-2026-0001)
- Stok tidak boleh negatif
- Alert stok rendah jika stok < 10 (threshold bisa dikonfigurasi)
- Saat hapus barang, data terhapus permanent (atau soft delete)
- Harga disimpan dalam satuan rupiah (tanpa desimal)

### Dashboard

**Business Rules:**
- Statistik dihitung real-time dari database
- Total nilai = SUM(stock * price) dari semua items
- Barang stok rendah = items dengan stock < 10
- Refresh otomatis setiap load halaman

### Autentikasi

**Business Rules:**
- Semua halaman kecuali login memerlukan autentikasi
- Session timeout: 120 menit (configurable)
- Password harus minimal 8 karakter

---

## 👥 USER STORIES

### Epic 1: Manajemen Kategori

**US-001: Melihat Daftar Kategori**
- **Sebagai** user
- **Saya ingin** melihat daftar semua kategori
- **Agar** saya tahu kategori apa saja yang tersedia

**US-002: Menambah Kategori Baru**
- **Sebagai** admin
- **Saya ingin** menambah kategori baru
- **Agar** barang bisa dikelompokkan sesuai jenis

**US-003: Mengedit Kategori**
- **Sebagai** admin
- **Saya ingin** mengubah nama kategori
- **Agar** kategori sesuai dengan kebutuhan terkini

**US-004: Menghapus Kategori**
- **Sebagai** admin
- **Saya ingin** menghapus kategori yang tidak digunakan
- **Agar** data tetap clean dan relevan

### Epic 2: Manajemen Barang

**US-005: Melihat Daftar Barang**
- **Sebagai** user
- **Saya ingin** melihat semua barang dengan info lengkap
- **Agar** saya tahu barang apa saja yang ada di inventaris

**US-006: Menambah Barang Baru**
- **Sebagai** staff gudang
- **Saya ingin** menambah barang baru ke sistem
- **Agar** inventaris selalu up-to-date

**US-007: Mengedit Data Barang**
- **Sebagai** staff gudang
- **Saya ingin** mengubah data barang (nama, stok, harga)
- **Agar** informasi barang akurat

**US-008: Mencari Barang**
- **Sebagai** user
- **Saya ingin** mencari barang berdasarkan kode atau nama
- **Agar** saya cepat menemukan barang yang dicari

**US-009: Filter Barang per Kategori**
- **Sebagai** user
- **Saya ingin** filter barang berdasarkan kategori
- **Agar** saya hanya melihat barang dari kategori tertentu

### Epic 3: Monitoring Stok

**US-010: Melihat Dashboard**
- **Sebagai** manager
- **Saya ingin** melihat statistik inventaris di dashboard
- **Agar** saya punya overview kondisi inventaris

**US-011: Notifikasi Stok Rendah**
- **Sebagai** manager
- **Saya ingin** tahu barang mana yang stoknya rendah
- **Agar** bisa segera melakukan restock

---

## 🔧 TEKNOLOGI & TOOLS

### Backend
- **Framework**: Laravel 11.x
- **PHP**: Version 8.2+
- **Database**: MySQL 8.0+
- **ORM**: Eloquent

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: Bootstrap 5.3 atau Tailwind CSS
- **JavaScript**: Vanilla JS atau Alpine.js
- **Icons**: Font Awesome atau Bootstrap Icons
- **Charts**: Chart.js
- **Alerts**: SweetAlert2

### Development Tools
- **Package Manager**: Composer, NPM
- **Build Tool**: Vite
- **Version Control**: Git
- **Code Editor**: VS Code

---

## 📱 RESPONSIVE DESIGN

Aplikasi harus responsive dan bisa diakses dari:
- **Desktop**: 1920x1080 dan lebih kecil
- **Tablet**: 768px - 1024px
- **Mobile**: 320px - 767px (optional, prioritas rendah)

---

## 🔐 KEAMANAN

### Autentikasi & Autorisasi
- Menggunakan Laravel Authentication (Breeze/UI)
- Session-based authentication
- CSRF protection di semua form
- Password hashing dengan bcrypt

### Validasi Data
- Server-side validation wajib untuk semua input
- Client-side validation untuk UX (optional)
- Sanitasi input untuk mencegah XSS
- Prepared statements untuk mencegah SQL injection (Eloquent)

### Best Practices
- Gunakan middleware `auth` untuk proteksi routes
- Validasi authorization sebelum edit/delete
- Logging untuk operasi critical

---

## 📊 ACCEPTANCE CRITERIA

### Definisi "Done" untuk Setiap Fitur:
1. ✅ Kode mengikuti PSR-12 coding standards
2. ✅ Validasi input berfungsi dengan benar
3. ✅ UI responsive dan user-friendly
4. ✅ Tidak ada error di browser console
5. ✅ Database queries optimal (gunakan eager loading jika perlu)
6. ✅ Flash messages untuk user feedback
7. ✅ Tested secara manual (minimal happy path)

---

## 🚀 RENCANA RILIS

### MVP (Minimum Viable Product) - Version 1.0
**Fitur yang harus ada:**
- ✅ Autentikasi (Login/Logout)
- ✅ CRUD Kategori
- ✅ CRUD Barang
- ✅ Dashboard dengan statistik dasar
- ✅ Search dan filter barang

### Version 1.1 (Enhancement)
- 📋 Export data ke Excel
- 📋 Advanced filtering
- 📋 Laporan inventaris
- 📋 Audit log

### Version 2.0 (Future)
- 📋 Multi-user roles (Admin, Staff, Viewer)
- 📋 API untuk integrasi
- 📋 Notifikasi email stok rendah
- 📋 Barcode scanning
- 📋 Transaksi keluar-masuk barang

---

## 📝 CATATAN TAMBAHAN

- Desain ini bersifat fleksibel dan bisa disesuaikan selama development
- Prioritaskan fitur MVP sebelum enhancement
- Komunikasi tim penting untuk alignment
- Update dokumen ini jika ada perubahan requirement

---

**Dokumen ini adalah living document dan akan diupdate sesuai kebutuhan proyek.**
