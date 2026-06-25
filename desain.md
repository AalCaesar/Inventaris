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

## 💎 PREMIUM DESIGN SYSTEM

### Color Palette (Elegant & Professional)

**Primary Colors:**
- **Navy Blue (Primary)**: `#1e3a8a` - Header, buttons, accents
- **Royal Blue**: `#2563eb` - Hover states, links
- **Light Blue**: `#3b82f6` - Active states, highlights

**Neutral Colors:**
- **White**: `#ffffff` - Background, cards
- **Light Gray**: `#f8fafc` - Secondary background
- **Medium Gray**: `#e2e8f0` - Borders, dividers
- **Dark Gray**: `#64748b` - Secondary text
- **Charcoal**: `#1e293b` - Primary text

**Accent Colors:**
- **Success Green**: `#10b981` - Success messages, positive actions
- **Warning Amber**: `#f59e0b` - Warnings, low stock alerts
- **Danger Red**: `#ef4444` - Errors, delete actions
- **Info Cyan**: `#06b6d4` - Info messages, tooltips

### Typography System

**Font Family:**
- Primary: `'Inter', 'Segoe UI', system-ui, sans-serif`
- Monospace (kode): `'JetBrains Mono', 'Fira Code', monospace`

**Font Sizes (rem):**
- **Heading 1**: 2.5rem (40px) - Page titles
- **Heading 2**: 2rem (32px) - Section headers
- **Heading 3**: 1.5rem (24px) - Card titles
- **Body Large**: 1.125rem (18px) - Important text
- **Body**: 1rem (16px) - Regular text
- **Small**: 0.875rem (14px) - Captions, labels
- **Tiny**: 0.75rem (12px) - Timestamps, metadata

**Font Weights:**
- Light: 300
- Regular: 400
- Medium: 500
- Semibold: 600
- Bold: 700

### Spacing System (8px base unit)

**Spacing Scale:**
- **xs**: 4px (0.25rem) - Tight spacing
- **sm**: 8px (0.5rem) - Close elements
- **md**: 16px (1rem) - Default spacing
- **lg**: 24px (1.5rem) - Section spacing
- **xl**: 32px (2rem) - Large gaps
- **2xl**: 48px (3rem) - Page sections
- **3xl**: 64px (4rem) - Major sections

### Shadow System (Soft & Elegant)

**Elevation Levels:**
- **Shadow XS** (Subtle): `0 1px 2px rgba(0, 0, 0, 0.05)`
- **Shadow SM** (Cards): `0 2px 4px rgba(30, 58, 138, 0.08)`
- **Shadow MD** (Elevated): `0 4px 12px rgba(30, 58, 138, 0.12)`
- **Shadow LG** (Modal): `0 8px 24px rgba(30, 58, 138, 0.16)`
- **Shadow XL** (Dropdown): `0 12px 32px rgba(30, 58, 138, 0.20)`

### Button Styles (Premium with Hover Effects)

**Primary Button:**
```css
background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
color: #ffffff;
padding: 12px 24px;
border-radius: 8px;
font-weight: 600;
box-shadow: 0 4px 12px rgba(30, 58, 138, 0.20);
transition: all 0.3s ease;

/* Hover */
transform: translateY(-2px);
box-shadow: 0 8px 20px rgba(30, 58, 138, 0.30);
```

**Secondary Button:**
```css
background: #ffffff;
color: #1e3a8a;
border: 2px solid #e2e8f0;
padding: 12px 24px;
border-radius: 8px;
font-weight: 600;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
transition: all 0.3s ease;

/* Hover */
border-color: #2563eb;
color: #2563eb;
background: #f8fafc;
```

**Success/Danger/Warning Buttons:**
- Similar style dengan warna sesuai (green/red/amber)
- Consistent shadow dan hover effects

### Card Styles (Clean & Modern)

**Standard Card:**
```css
background: #ffffff;
border-radius: 12px;
padding: 24px;
box-shadow: 0 2px 8px rgba(30, 58, 138, 0.08);
border: 1px solid #e2e8f0;
transition: all 0.3s ease;

/* Hover */
box-shadow: 0 4px 16px rgba(30, 58, 138, 0.12);
transform: translateY(-2px);
```

**Stats Card:**
- Border-left accent (4px solid primary/success/warning/danger)
- Icon dengan gradient background
- Large number typography (2.5rem, bold)

### Table Styles (Professional)

**Table Header:**
```css
background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
color: #1e293b;
font-weight: 600;
font-size: 0.875rem;
text-transform: uppercase;
letter-spacing: 0.05em;
border-bottom: 2px solid #e2e8f0;
```

**Table Rows:**
- Alternating background (#ffffff / #f8fafc)
- Hover state: `background: #f1f5f9; transition: 0.2s`
- Border-bottom: `1px solid #f1f5f9`

### Form Elements (Clean & Accessible)

**Input Fields:**
```css
border: 2px solid #e2e8f0;
border-radius: 8px;
padding: 12px 16px;
font-size: 1rem;
transition: all 0.3s ease;

/* Focus */
border-color: #2563eb;
box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
outline: none;
```

**Labels:**
- Font-weight: 600
- Color: #1e293b
- Margin-bottom: 8px

### Badge Styles

**Success Badge** (In Stock):
```css
background: #d1fae5;
color: #065f46;
padding: 4px 12px;
border-radius: 12px;
font-weight: 600;
font-size: 0.75rem;
```

**Warning Badge** (Low Stock):
```css
background: #fef3c7;
color: #92400e;
/* Similar styling */
```

**Danger Badge** (Out of Stock):
```css
background: #fee2e2;
color: #991b1b;
/* Similar styling */
```

### Responsive Breakpoints

**Mobile First Approach:**
- **Mobile**: < 640px (sm)
- **Tablet**: 640px - 1024px (md/lg)
- **Desktop**: > 1024px (xl/2xl)

**Responsive Guidelines:**
- Cards: Stack vertically on mobile (col-12), 2 columns on tablet, 4 columns on desktop
- Tables: Card-style layout on mobile (horizontal scroll alternative)
- Buttons: Full width on mobile, auto width on desktop
- Sidebar: Hamburger menu on mobile, fixed sidebar on desktop
- Font sizes: Scale down 10-15% on mobile
- Spacing: Reduce padding/margin by 25-30% on mobile

### Animation & Transitions

**Standard Transitions:**
- Duration: `0.3s`
- Easing: `cubic-bezier(0.4, 0, 0.2, 1)` (ease-in-out)

**Hover Effects:**
- Buttons: `translateY(-2px)` + shadow increase
- Cards: `translateY(-2px)` + shadow increase
- Links: Color change + underline animation

**Loading States:**
- Skeleton screens with shimmer effect
- Spinner: Primary color with smooth rotation

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
