# Screenshots Guide

File ini mendokumentasikan screenshots yang perlu di-capture untuk dokumentasi project Inventaris.

## Screenshots Yang Dibutuhkan

### 1. Dashboard View
**File:** `dashboard.png`  
**URL:** `http://localhost:8000/dashboard`  
**Deskripsi:** Tampilan halaman dashboard dengan:
- 4 statistics cards (Total Kategori, Total Barang, Total Nilai Inventaris, Stok Rendah)
- Tabel barang dengan stok rendah (10 items)
- Bar chart distribusi barang per kategori

**Cara Capture:**
1. Login ke aplikasi
2. Pastikan ada data kategori dan barang di database
3. Navigate ke dashboard
4. Capture full page screenshot

---

### 2. Categories List
**File:** `categories-list.png`  
**URL:** `http://localhost:8000/categories`  
**Deskripsi:** Tampilan halaman daftar kategori dengan:
- Search bar
- Tabel kategori dengan kolom: No, Nama Kategori, Jumlah Barang, Aksi
- Pagination (jika ada >10 kategori)
- Button "Tambah Kategori"

**Cara Capture:**
1. Navigate ke `/categories`
2. Pastikan ada minimal 5-10 kategori
3. Capture screenshot yang menunjukkan search bar, tabel, dan pagination

---

### 3. Items List
**File:** `items-list.png`  
**URL:** `http://localhost:8000/items`  
**Deskripsi:** Tampilan halaman daftar barang dengan:
- Search bar dan filter kategori
- Tabel barang dengan kolom: No, Kode Barang, Nama, Kategori, Stok, Harga, Aksi
- Badge warning untuk barang dengan stok < 10
- Format harga Rupiah
- Pagination (jika ada >15 barang)

**Cara Capture:**
1. Navigate ke `/items`
2. Pastikan ada barang dengan berbagai kategori
3. Pastikan ada beberapa barang dengan stok < 10 (untuk badge warning)
4. Capture screenshot yang menunjukkan search, filter, tabel, dan pagination

---

### 4. Add/Edit Form
**File:** `item-form.png`  
**URL:** `http://localhost:8000/items/create` atau `http://localhost:8000/items/{id}/edit`  
**Deskripsi:** Tampilan form tambah/edit barang dengan:
- Field: Kode Barang, Nama Barang, Kategori (dropdown), Stok, Harga
- Validation messages (capture saat ada error)
- Button Save/Cancel

**Cara Capture:**
1. Navigate ke form create atau edit
2. Optional: Submit form kosong untuk menunjukkan validation errors
3. Capture screenshot form lengkap

---

## Format Screenshots

- **Format:** PNG
- **Resolusi:** 1920x1080 (Desktop view)
- **Browser:** Chrome atau Firefox (latest version)
- **Lokasi simpan:** `docs/screenshots/`

## Setelah Capture

Setelah semua screenshots di-capture, update README.md dengan menambahkan section "Screenshots" yang menampilkan gambar-gambar tersebut.

Contoh format untuk README.md:

```markdown
## Screenshots

### Dashboard
![Dashboard](docs/screenshots/dashboard.png)

### Categories Management
![Categories List](docs/screenshots/categories-list.png)

### Items Management
![Items List](docs/screenshots/items-list.png)

### Add/Edit Form
![Item Form](docs/screenshots/item-form.png)
```
