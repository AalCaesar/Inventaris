# Testing Checklist - Aplikasi Inventaris

**Versi:** 1.0  
**Tanggal:** 2026-06-24  
**Status:** 🟡 Awaiting Manual Testing

**Production URL:** https://inventaris-production-f841.up.railway.app/

**Pre-Deployment Verification:** ✅ Complete
- ✅ Application deployed to Railway
- ✅ Public pages accessible (landing, login, register)
- ✅ HTTPS/SSL enabled
- ✅ No server errors on public pages

**Manual Testing Required:** 🔴 86 test cases require human interaction (login, CRUD operations, forms)

---

## Daftar Isi
1. [Testing CRUD Kategori](#1-testing-crud-kategori)
2. [Testing CRUD Barang](#2-testing-crud-barang)
3. [Testing Search dan Filter](#3-testing-search-dan-filter)
4. [Testing Dashboard](#4-testing-dashboard)
5. [Testing Validasi Form](#5-testing-validasi-form)
6. [Testing Error Handling](#6-testing-error-handling)
7. [Testing Flash Messages](#7-testing-flash-messages)
8. [Testing Responsive Design](#8-testing-responsive-design)
9. [Testing Pagination](#9-testing-pagination)
10. [Testing Authentication](#10-testing-authentication)

---

## 1. Testing CRUD Kategori

### TC-KAT-001: Tampilan Halaman Daftar Kategori
- [ ] **Tested**

**Deskripsi:** Verifikasi halaman daftar kategori tampil dengan benar

**Steps to Test:**
1. Login ke aplikasi
2. Navigate ke menu "Kategori" atau akses `/categories`
3. Periksa tampilan tabel kategori

**Expected Result:**
- Halaman menampilkan tabel dengan kolom: ID, Nama Kategori, Deskripsi, Jumlah Items, Actions
- Tombol "Tambah Kategori Baru" terlihat
- Data kategori ditampilkan dalam tabel

---

### TC-KAT-002: Tambah Kategori Baru (Valid Data)
- [ ] **Tested**

**Deskripsi:** Tambah kategori dengan data yang valid

**Steps to Test:**
1. Klik tombol "Tambah Kategori Baru"
2. Isi form:
   - Nama: "Elektronik Test"
   - Deskripsi: "Kategori untuk barang elektronik"
3. Klik tombol "Simpan"

**Expected Result:**
- Redirect ke halaman daftar kategori
- Flash message success muncul: "Kategori berhasil ditambahkan"
- Kategori baru muncul di tabel
- Data tersimpan di database

---

### TC-KAT-003: Tambah Kategori (Nama Kosong)
- [ ] **Tested**

**Deskripsi:** Validasi field required untuk nama kategori

**Steps to Test:**
1. Klik "Tambah Kategori Baru"
2. Kosongkan field "Nama"
3. Isi deskripsi: "Test deskripsi"
4. Klik "Simpan"

**Expected Result:**
- Form tidak tersubmit
- Error message muncul: "Nama kategori harus diisi"
- User tetap di halaman form

---

### TC-KAT-004: Tambah Kategori (Nama Duplicate)
- [ ] **Tested**

**Deskripsi:** Validasi unique constraint untuk nama kategori

**Steps to Test:**
1. Pastikan sudah ada kategori dengan nama "Elektronik"
2. Klik "Tambah Kategori Baru"
3. Isi nama: "Elektronik" (duplikat)
4. Klik "Simpan"

**Expected Result:**
- Error message: "Nama kategori sudah ada"
- Data tidak tersimpan
- User tetap di halaman form dengan data yang diisi

---

### TC-KAT-005: View Detail Kategori
- [ ] **Tested**

**Deskripsi:** Melihat detail informasi kategori

**Steps to Test:**
1. Dari daftar kategori, klik tombol "View" pada salah satu kategori
2. Periksa informasi yang ditampilkan

**Expected Result:**
- Halaman detail menampilkan:
  - Nama kategori
  - Deskripsi
  - Jumlah items dalam kategori
  - Daftar items yang termasuk dalam kategori (jika ada)
- Tombol "Edit" dan "Kembali" tersedia

---

### TC-KAT-006: Edit Kategori (Valid Data)
- [ ] **Tested**

**Deskripsi:** Update data kategori dengan data valid

**Steps to Test:**
1. Klik tombol "Edit" pada salah satu kategori
2. Ubah nama menjadi: "Elektronik Updated"
3. Ubah deskripsi
4. Klik "Update"

**Expected Result:**
- Redirect ke halaman daftar kategori
- Flash message: "Kategori berhasil diupdate"
- Data kategori berubah di tabel
- Perubahan tersimpan di database

---

### TC-KAT-007: Edit Kategori (Nama Kosong)
- [ ] **Tested**

**Deskripsi:** Validasi required field saat edit

**Steps to Test:**
1. Klik "Edit" pada kategori
2. Hapus nama kategori (kosongkan)
3. Klik "Update"

**Expected Result:**
- Error message: "Nama kategori harus diisi"
- Data tidak berubah
- User tetap di halaman edit

---

### TC-KAT-008: Delete Kategori (Tanpa Items)
- [ ] **Tested**

**Deskripsi:** Hapus kategori yang tidak memiliki items

**Steps to Test:**
1. Buat kategori baru tanpa items
2. Klik tombol "Delete" pada kategori tersebut
3. Konfirmasi delete (jika ada confirmation dialog)

**Expected Result:**
- Kategori terhapus dari daftar
- Flash message: "Kategori berhasil dihapus"
- Data terhapus dari database

---

### TC-KAT-009: Delete Kategori (Dengan Items)
- [ ] **Tested**

**Deskripsi:** Cegah penghapusan kategori yang masih memiliki items

**Steps to Test:**
1. Pilih kategori yang memiliki items
2. Klik tombol "Delete"
3. Konfirmasi delete

**Expected Result:**
- Error message: "Kategori tidak dapat dihapus karena masih memiliki items"
- Kategori tidak terhapus
- Data tetap ada di database

---

### TC-KAT-010: Cancel Create Kategori
- [ ] **Tested**

**Deskripsi:** Batal membuat kategori baru

**Steps to Test:**
1. Klik "Tambah Kategori Baru"
2. Isi beberapa field
3. Klik tombol "Batal" atau "Cancel"

**Expected Result:**
- Redirect ke halaman daftar kategori
- Data tidak tersimpan
- Tidak ada flash message

---

## 2. Testing CRUD Barang

### TC-ITEM-001: Tampilan Halaman Daftar Barang
- [ ] **Tested**

**Deskripsi:** Verifikasi halaman daftar barang tampil dengan benar

**Steps to Test:**
1. Navigate ke menu "Barang" atau akses `/items`
2. Periksa tampilan tabel barang

**Expected Result:**
- Tabel menampilkan kolom: Kode Barang, Nama, Kategori, Stok, Lokasi, Actions
- Tombol "Tambah Barang Baru" tersedia
- Search box tersedia
- Filter kategori tersedia

---

### TC-ITEM-002: Tambah Barang Baru (Valid Data)
- [ ] **Tested**

**Deskripsi:** Tambah barang dengan semua data valid

**Steps to Test:**
1. Klik "Tambah Barang Baru"
2. Isi form:
   - Kode Barang: "IT-001"
   - Nama: "Laptop Dell"
   - Kategori: Pilih "Elektronik"
   - Stok: 5
   - Lokasi: "Gudang A"
   - Deskripsi: "Laptop untuk kantor"
3. Klik "Simpan"

**Expected Result:**
- Redirect ke halaman daftar barang
- Flash message: "Barang berhasil ditambahkan"
- Barang baru muncul di tabel
- Data tersimpan dengan benar

---

### TC-ITEM-003: Tambah Barang (Kode Duplikat)
- [ ] **Tested**

**Deskripsi:** Validasi unique constraint untuk kode barang

**Steps to Test:**
1. Pastikan sudah ada barang dengan kode "IT-001"
2. Coba tambah barang baru dengan kode "IT-001"
3. Isi field lainnya dengan data valid
4. Klik "Simpan"

**Expected Result:**
- Error message: "Kode barang sudah ada"
- Data tidak tersimpan
- Form tetap menampilkan data yang diisi

---

### TC-ITEM-004: Tambah Barang (Field Required Kosong)
- [ ] **Tested**

**Deskripsi:** Validasi field required

**Steps to Test:**
1. Klik "Tambah Barang Baru"
2. Kosongkan field: Kode Barang
3. Isi field lainnya
4. Klik "Simpan"

**Expected Result:**
- Error message: "Kode barang harus diisi"
- Data tidak tersimpan

**Ulangi untuk field required lainnya:**
- [ ] Nama barang
- [ ] Kategori
- [ ] Stok

---

### TC-ITEM-005: Tambah Barang (Stok Negatif)
- [ ] **Tested**

**Deskripsi:** Validasi format stok (harus positif)

**Steps to Test:**
1. Isi form barang baru
2. Isi stok dengan nilai negatif: -5
3. Klik "Simpan"

**Expected Result:**
- Error message: "Stok harus berupa angka positif"
- Data tidak tersimpan

---

### TC-ITEM-006: View Detail Barang
- [ ] **Tested**

**Deskripsi:** Melihat detail lengkap barang

**Steps to Test:**
1. Klik tombol "View" pada salah satu barang
2. Periksa informasi yang ditampilkan

**Expected Result:**
- Menampilkan semua informasi barang:
  - Kode barang
  - Nama
  - Kategori
  - Stok
  - Lokasi
  - Deskripsi
- Tombol "Edit" dan "Kembali" tersedia

---

### TC-ITEM-007: Edit Barang (Valid Data)
- [ ] **Tested**

**Deskripsi:** Update data barang dengan data valid

**Steps to Test:**
1. Klik "Edit" pada salah satu barang
2. Ubah beberapa field (nama, stok, lokasi)
3. Klik "Update"

**Expected Result:**
- Redirect ke daftar barang
- Flash message: "Barang berhasil diupdate"
- Perubahan tersimpan di database
- Tabel menampilkan data yang diupdate

---

### TC-ITEM-008: Edit Barang (Kode Tidak Bisa Diubah)
- [ ] **Tested**

**Deskripsi:** Verifikasi kode barang tidak dapat diubah saat edit

**Steps to Test:**
1. Klik "Edit" pada barang
2. Periksa field "Kode Barang"

**Expected Result:**
- Field kode barang disabled atau readonly
- User tidak dapat mengubah kode barang

---

### TC-ITEM-009: Delete Barang
- [ ] **Tested**

**Deskripsi:** Hapus barang dari sistem

**Steps to Test:**
1. Klik tombol "Delete" pada salah satu barang
2. Konfirmasi penghapusan

**Expected Result:**
- Barang terhapus dari daftar
- Flash message: "Barang berhasil dihapus"
- Data terhapus dari database

---

### TC-ITEM-010: Cancel Create Barang
- [ ] **Tested**

**Deskripsi:** Batal menambah barang baru

**Steps to Test:**
1. Klik "Tambah Barang Baru"
2. Isi beberapa field
3. Klik "Cancel"

**Expected Result:**
- Redirect ke daftar barang
- Data tidak tersimpan

---

## 3. Testing Search dan Filter

### TC-SEARCH-001: Search by Nama Barang
- [ ] **Tested**

**Deskripsi:** Mencari barang berdasarkan nama

**Steps to Test:**
1. Di halaman daftar barang, locate search box
2. Ketik nama barang yang ada di database, misal: "Laptop"
3. Tekan Enter atau klik tombol Search

**Expected Result:**
- Tabel hanya menampilkan barang yang namanya mengandung "Laptop"
- Barang lain tidak ditampilkan
- Jika tidak ada hasil, tampilkan pesan "Tidak ada barang ditemukan"

---

### TC-SEARCH-002: Search by Kode Barang
- [ ] **Tested**

**Deskripsi:** Mencari barang berdasarkan kode

**Steps to Test:**
1. Di search box, ketik kode barang yang ada, misal: "IT-001"
2. Submit search

**Expected Result:**
- Menampilkan barang dengan kode "IT-001"
- Search berfungsi untuk kode barang

---

### TC-SEARCH-003: Search dengan Keyword Tidak Ditemukan
- [ ] **Tested**

**Deskripsi:** Search dengan keyword yang tidak ada di database

**Steps to Test:**
1. Ketik keyword yang tidak ada: "XYZ12345NOTFOUND"
2. Submit search

**Expected Result:**
- Tabel kosong
- Pesan "Tidak ada barang ditemukan" atau similar message
- Tidak ada error

---

### TC-SEARCH-004: Clear Search
- [ ] **Tested**

**Deskripsi:** Kembali ke view semua barang setelah search

**Steps to Test:**
1. Lakukan search dengan keyword tertentu
2. Clear search box atau klik tombol "Reset" / "Clear"
3. Submit atau reload

**Expected Result:**
- Menampilkan semua barang kembali
- Search filter ter-reset

---

### TC-FILTER-001: Filter by Kategori
- [ ] **Tested**

**Deskripsi:** Filter barang berdasarkan kategori

**Steps to Test:**
1. Locate filter dropdown "Kategori"
2. Pilih salah satu kategori, misal: "Elektronik"
3. Lihat hasil filtering

**Expected Result:**
- Hanya menampilkan barang dengan kategori "Elektronik"
- Barang dari kategori lain tidak ditampilkan

---

### TC-FILTER-002: Filter "Semua Kategori"
- [ ] **Tested**

**Deskripsi:** Reset filter kategori

**Steps to Test:**
1. Setelah filter kategori aktif
2. Pilih opsi "Semua Kategori" atau "All"

**Expected Result:**
- Menampilkan barang dari semua kategori
- Filter ter-reset

---

### TC-FILTER-003: Kombinasi Search dan Filter
- [ ] **Tested**

**Deskripsi:** Gunakan search dan filter bersamaan

**Steps to Test:**
1. Pilih kategori "Elektronik"
2. Di search box, ketik "Laptop"
3. Submit

**Expected Result:**
- Menampilkan barang yang:
  - Kategorinya "Elektronik" DAN
  - Namanya mengandung "Laptop"
- Kombinasi filter bekerja dengan benar

---

### TC-FILTER-004: Filter dengan Kategori Tanpa Items
- [ ] **Tested**

**Deskripsi:** Filter kategori yang tidak memiliki items

**Steps to Test:**
1. Buat kategori baru tanpa items
2. Filter berdasarkan kategori tersebut

**Expected Result:**
- Tabel kosong
- Pesan "Tidak ada barang dalam kategori ini"
- Tidak ada error

---

## 4. Testing Dashboard

### TC-DASH-001: Akses Dashboard
- [ ] **Tested**

**Deskripsi:** Membuka halaman dashboard

**Steps to Test:**
1. Login ke aplikasi
2. Navigate ke Dashboard (biasanya halaman home)

**Expected Result:**
- Dashboard tampil dengan statistik cards
- Tidak ada error
- Loading semua data berhasil

---

### TC-DASH-002: Verifikasi Total Kategori
- [ ] **Tested**

**Deskripsi:** Pastikan statistik total kategori akurat

**Steps to Test:**
1. Hitung manual jumlah kategori di database atau di halaman Kategori
2. Bandingkan dengan angka di dashboard card "Total Kategori"

**Expected Result:**
- Angka di dashboard sama dengan jumlah kategori aktual
- Statistik akurat

---

### TC-DASH-003: Verifikasi Total Barang
- [ ] **Tested**

**Deskripsi:** Pastikan statistik total barang akurat

**Steps to Test:**
1. Hitung jumlah barang di database atau halaman Items
2. Bandingkan dengan dashboard card "Total Barang"

**Expected Result:**
- Angka di dashboard sama dengan jumlah barang aktual
- Statistik akurat

---

### TC-DASH-004: Verifikasi Total Stok
- [ ] **Tested**

**Deskripsi:** Pastikan total stok dihitung dengan benar

**Steps to Test:**
1. Manually sum up stok dari semua barang
2. Bandingkan dengan dashboard card "Total Stok"

**Expected Result:**
- Total stok di dashboard = SUM(stok semua barang)
- Perhitungan benar

---

### TC-DASH-005: Verifikasi Low Stock Items
- [ ] **Tested**

**Deskripsi:** Verifikasi daftar barang dengan stok rendah

**Steps to Test:**
1. Identifikasi barang dengan stok <= threshold (misalnya <= 5)
2. Cek section "Low Stock Items" di dashboard

**Expected Result:**
- Menampilkan barang dengan stok rendah
- List akurat sesuai threshold
- Jika tidak ada, tampilkan pesan "Semua barang stoknya cukup"

---

### TC-DASH-006: Chart Barang per Kategori
- [ ] **Tested**

**Deskripsi:** Verifikasi chart/grafik distribusi barang per kategori

**Steps to Test:**
1. Hitung manual jumlah barang per kategori
2. Bandingkan dengan data di chart (bar/pie chart)

**Expected Result:**
- Chart menampilkan data yang akurat
- Setiap kategori memiliki jumlah yang benar
- Chart ter-render dengan baik (menggunakan Chart.js)

---

### TC-DASH-007: Real-time Update Dashboard
- [ ] **Tested**

**Deskripsi:** Dashboard ter-update setelah perubahan data

**Steps to Test:**
1. Catat statistik di dashboard
2. Tambah barang baru atau kategori baru
3. Kembali ke dashboard (refresh atau navigate)

**Expected Result:**
- Statistik ter-update dengan data terbaru
- Tidak perlu clear cache
- Real-time atau update setelah refresh

---

### TC-DASH-008: Dashboard Performance
- [ ] **Tested**

**Deskripsi:** Dashboard load dengan cepat

**Steps to Test:**
1. Access dashboard dengan banyak data (100+ items)
2. Perhatikan loading time

**Expected Result:**
- Dashboard load dalam waktu wajar (< 3 detik)
- Tidak ada lag saat render chart
- Performance acceptable

---

## 5. Testing Validasi Form

### TC-VAL-001: Required Field - Kategori Name
- [ ] **Tested**

**Deskripsi:** Validasi field required nama kategori

**Steps to Test:**
1. Form tambah/edit kategori
2. Submit tanpa mengisi nama

**Expected Result:**
- Error: "Nama kategori harus diisi"
- Form tidak tersubmit

---

### TC-VAL-002: Required Field - Item Code
- [ ] **Tested**

**Deskripsi:** Validasi field required kode barang

**Steps to Test:**
1. Form tambah barang
2. Submit tanpa kode barang

**Expected Result:**
- Error: "Kode barang harus diisi"
- Form tidak tersubmit

---

### TC-VAL-003: Required Field - Item Name
- [ ] **Tested**

**Deskripsi:** Validasi field required nama barang

**Steps to Test:**
1. Form tambah barang
2. Submit tanpa nama

**Expected Result:**
- Error: "Nama barang harus diisi"

---

### TC-VAL-004: Required Field - Category Selection
- [ ] **Tested**

**Deskripsi:** Validasi kategori harus dipilih

**Steps to Test:**
1. Form tambah barang
2. Submit tanpa memilih kategori

**Expected Result:**
- Error: "Kategori harus dipilih"

---

### TC-VAL-005: Required Field - Stock
- [ ] **Tested**

**Deskripsi:** Validasi field stok required

**Steps to Test:**
1. Form tambah barang
2. Kosongkan field stok
3. Submit

**Expected Result:**
- Error: "Stok harus diisi"

---

### TC-VAL-006: Numeric Validation - Stock Positive
- [ ] **Tested**

**Deskripsi:** Stok harus berupa angka positif

**Steps to Test:**
1. Isi stok dengan nilai negatif: -10
2. Submit

**Expected Result:**
- Error: "Stok harus berupa angka positif"

---

### TC-VAL-007: Numeric Validation - Stock Not String
- [ ] **Tested**

**Deskripsi:** Stok harus berupa angka, bukan string

**Steps to Test:**
1. Isi stok dengan text: "abc"
2. Submit

**Expected Result:**
- Error: "Stok harus berupa angka"
- atau field tidak menerima input non-numeric (jika type="number")

---

### TC-VAL-008: Unique Constraint - Item Code
- [ ] **Tested**

**Deskripsi:** Kode barang harus unique

**Steps to Test:**
1. Tambah barang dengan kode "TEST-001"
2. Coba tambah barang lagi dengan kode yang sama

**Expected Result:**
- Error: "Kode barang sudah ada"
- Data tidak tersimpan

---

### TC-VAL-009: Unique Constraint - Category Name
- [ ] **Tested**

**Deskripsi:** Nama kategori harus unique

**Steps to Test:**
1. Tambah kategori "Elektronik"
2. Coba tambah kategori dengan nama yang sama

**Expected Result:**
- Error: "Nama kategori sudah ada"

---

### TC-VAL-010: Max Length Validation
- [ ] **Tested**

**Deskripsi:** Validasi panjang maksimal field (jika ada)

**Steps to Test:**
1. Coba isi field dengan string sangat panjang (500+ characters)
2. Submit

**Expected Result:**
- Error message jika melebihi max length
- atau field dibatasi max input length

---

## 6. Testing Error Handling

### TC-ERR-001: 404 - Kategori Not Found
- [ ] **Tested**

**Deskripsi:** Handle kategori yang tidak ada di database

**Steps to Test:**
1. Akses URL kategori yang tidak ada: `/categories/999999`
2. Periksa response

**Expected Result:**
- Tampilkan halaman 404 atau error page
- Pesan error: "Kategori tidak ditemukan"
- Tidak ada crash/exception

---

### TC-ERR-002: 404 - Barang Not Found
- [ ] **Tested**

**Deskripsi:** Handle barang yang tidak ada

**Steps to Test:**
1. Akses URL barang yang tidak ada: `/items/999999`
2. Periksa response

**Expected Result:**
- Halaman 404 atau error yang user-friendly
- Pesan: "Barang tidak ditemukan"
- Link untuk kembali ke daftar barang

---

### TC-ERR-003: Delete Kategori dengan Items (Error Handling)
- [ ] **Tested**

**Deskripsi:** Proper error handling saat delete kategori yang masih punya items

**Steps to Test:**
1. Pilih kategori dengan items
2. Coba delete
3. Konfirmasi

**Expected Result:**
- Error message jelas: "Tidak dapat menghapus kategori karena masih memiliki X items"
- Kategori tidak terhapus
- Flash error message ditampilkan
- User ter-redirect dengan aman

---

### TC-ERR-004: Database Connection Error (Simulation)
- [ ] **Tested**

**Deskripsi:** Handle error koneksi database

**Steps to Test:**
1. (Simulation) Stop database server atau putus koneksi
2. Coba akses halaman yang query database
3. Periksa error handling

**Expected Result:**
- Error page yang user-friendly (bukan raw error)
- Pesan: "Terjadi kesalahan sistem, silakan coba lagi"
- Tidak expose detail teknis ke user
- Log error ke system log

---

### TC-ERR-005: Invalid Data Type (Stock as String)
- [ ] **Tested**

**Deskripsi:** Handle input dengan tipe data salah

**Steps to Test:**
1. Inspect element dan ubah input type="number" menjadi type="text"
2. Isi stok dengan "abc"
3. Submit

**Expected Result:**
- Validasi backend menangkap error
- Error message: "Stok harus berupa angka"
- Data tidak tersimpan

---

### TC-ERR-006: CSRF Token Missing/Invalid (Jika Implementasi CSRF)
- [ ] **Tested**

**Deskripsi:** Handle request tanpa CSRF token

**Steps to Test:**
1. (Manual) Remove CSRF token dari form
2. Submit form

**Expected Result:**
- Request ditolak
- Error: "Invalid request" atau CSRF error
- Security layer bekerja dengan baik

---

### TC-ERR-007: Validation Error dengan Multiple Fields
- [ ] **Tested**

**Deskripsi:** Handle multiple validation errors sekaligus

**Steps to Test:**
1. Submit form tambah barang dengan multiple field kosong
2. Periksa error display

**Expected Result:**
- Semua error ditampilkan (tidak hanya satu)
- Error message jelas per field
- Form data yang valid tetap ter-retain

---

### TC-ERR-008: SQL Injection Prevention
- [ ] **Tested**

**Deskripsi:** Aplikasi aman dari SQL injection

**Steps to Test:**
1. Di search box, input: `' OR '1'='1`
2. Di field nama kategori: `'; DROP TABLE categories; --`
3. Submit

**Expected Result:**
- Input di-escape dengan benar
- Tidak ada SQL injection terjadi
- Database tetap aman
- Input treated as literal string

---

## 7. Testing Flash Messages

### TC-FLASH-001: Success Message - Create Kategori
- [ ] **Tested**

**Deskripsi:** Flash message muncul setelah create kategori

**Steps to Test:**
1. Tambah kategori baru
2. Submit

**Expected Result:**
- Flash message hijau/success muncul
- Pesan: "Kategori berhasil ditambahkan"
- Message hilang setelah reload atau timeout

---

### TC-FLASH-002: Success Message - Update Barang
- [ ] **Tested**

**Deskripsi:** Flash message setelah update barang

**Steps to Test:**
1. Edit barang
2. Update

**Expected Result:**
- Success message: "Barang berhasil diupdate"
- Styling success (hijau/check icon)

---

### TC-FLASH-003: Success Message - Delete
- [ ] **Tested**

**Deskripsi:** Flash message setelah delete

**Steps to Test:**
1. Delete kategori atau barang
2. Konfirmasi

**Expected Result:**
- Success message: "Data berhasil dihapus"
- Message visible dan jelas

---

### TC-FLASH-004: Error Message - Validation Failed
- [ ] **Tested**

**Deskripsi:** Flash error message untuk validation

**Steps to Test:**
1. Submit form dengan data invalid
2. Periksa error message

**Expected Result:**
- Flash message merah/error muncul
- Pesan error jelas dan spesifik
- Styling error (merah/warning icon)

---

### TC-FLASH-005: Error Message - Delete Kategori dengan Items
- [ ] **Tested**

**Deskripsi:** Flash error untuk operasi yang gagal

**Steps to Test:**
1. Coba delete kategori dengan items

**Expected Result:**
- Error message: "Kategori tidak dapat dihapus karena masih memiliki items"
- Styling error
- User understand why operation failed

---

### TC-FLASH-006: Flash Message Auto-dismiss
- [ ] **Tested**

**Deskripsi:** Flash message hilang otomatis setelah beberapa detik

**Steps to Test:**
1. Trigger flash message (create/update/delete)
2. Tunggu beberapa detik (5-10 detik)

**Expected Result:**
- Message fade out atau hilang otomatis
- Tidak perlu close manual
- (Opsional feature - check if implemented)

---

### TC-FLASH-007: Flash Message Persisten Setelah Redirect
- [ ] **Tested**

**Deskripsi:** Flash message tetap muncul setelah redirect

**Steps to Test:**
1. Create kategori (yang trigger redirect)
2. Observe flash message di halaman destination

**Expected Result:**
- Flash message muncul di halaman setelah redirect
- Session flash working correctly

---

## 8. Testing Responsive Design

### TC-RESP-001: Mobile View (320px - 480px)
- [ ] **Tested**

**Deskripsi:** Layout responsive di mobile devices

**Steps to Test:**
1. Buka browser dev tools
2. Set viewport ke mobile (iPhone SE: 375x667)
3. Navigate semua halaman utama:
   - Dashboard
   - Daftar Kategori
   - Daftar Barang
   - Form tambah/edit

**Expected Result:**
- Layout tidak break
- Tabel ter-scroll horizontal atau responsive
- Tombol tidak overlap
- Text readable (tidak terpotong)
- Navigation menu responsive (burger menu jika ada)

---

### TC-RESP-002: Tablet View (768px - 1024px)
- [ ] **Tested**

**Deskripsi:** Layout di tablet devices

**Steps to Test:**
1. Set viewport ke tablet (iPad: 768x1024)
2. Test semua halaman

**Expected Result:**
- Layout utilize space dengan baik
- Tidak terlalu stretched atau cramped
- Navigation dan sidebar (jika ada) responsive

---

### TC-RESP-003: Desktop View (1920px+)
- [ ] **Tested**

**Deskripsi:** Layout di large desktop

**Steps to Test:**
1. Set viewport ke 1920x1080 atau larger
2. Test semua halaman

**Expected Result:**
- Layout tidak terlalu stretched
- Content centered atau dengan max-width yang reasonable
- Tidak ada white space berlebihan

---

### TC-RESP-004: Touch Targets (Mobile)
- [ ] **Tested**

**Deskripsi:** Button dan link cukup besar untuk touch

**Steps to Test:**
1. Mobile view
2. Periksa ukuran tombol (Edit, Delete, Submit, etc)

**Expected Result:**
- Touch targets minimal 44x44px
- Mudah di-tap tanpa misclick
- Spacing adequate antara buttons

---

### TC-RESP-005: Chart Responsive (Dashboard)
- [ ] **Tested**

**Deskripsi:** Chart.js responsive di berbagai ukuran layar

**Steps to Test:**
1. Buka dashboard
2. Resize browser dari mobile ke desktop

**Expected Result:**
- Chart resize dengan baik
- Tidak overflow container
- Tetap readable di mobile
- Chart.js responsive options working

---

## 9. Testing Pagination

### TC-PAGE-001: Pagination Display
- [ ] **Tested**

**Deskripsi:** Pagination muncul saat data melebihi limit per page

**Steps to Test:**
1. Pastikan ada >10 items (atau limit per page)
2. Buka halaman daftar barang

**Expected Result:**
- Pagination links muncul di bottom tabel
- Tampil: Previous, 1, 2, 3, ..., Next
- Current page ter-highlight

---

### TC-PAGE-002: Navigate ke Page 2
- [ ] **Tested**

**Deskripsi:** Klik pagination page 2

**Steps to Test:**
1. Klik link "2" di pagination
2. Periksa data yang ditampilkan

**Expected Result:**
- Data page 2 ditampilkan
- URL update dengan query param: `?page=2`
- Page 2 ter-highlight sebagai active

---

### TC-PAGE-003: Next Button
- [ ] **Tested**

**Deskripsi:** Tombol Next pagination

**Steps to Test:**
1. Di page 1, klik "Next"
2. Periksa

**Expected Result:**
- Pindah ke page 2
- Data berubah
- URL update

---

### TC-PAGE-004: Previous Button
- [ ] **Tested**

**Deskripsi:** Tombol Previous pagination

**Steps to Test:**
1. Navigate ke page 2
2. Klik "Previous"

**Expected Result:**
- Kembali ke page 1
- Data page 1 ditampilkan

---

### TC-PAGE-005: First dan Last Page
- [ ] **Tested**

**Deskripsi:** Navigate ke first dan last page

**Steps to Test:**
1. Klik page terakhir
2. Klik page pertama (1)

**Expected Result:**
- Navigasi bekerja dengan benar
- Data sesuai halaman

---

### TC-PAGE-006: Disabled State (Previous on Page 1)
- [ ] **Tested**

**Deskripsi:** Previous button disabled di page 1

**Steps to Test:**
1. Di page 1, periksa tombol Previous

**Expected Result:**
- Previous button disabled atau tidak muncul
- Tidak bisa klik ke page < 1

---

### TC-PAGE-007: Disabled State (Next on Last Page)
- [ ] **Tested**

**Deskripsi:** Next button disabled di last page

**Steps to Test:**
1. Navigate ke last page
2. Periksa tombol Next

**Expected Result:**
- Next button disabled atau tidak muncul
- Tidak bisa klik ke page > last

---

### TC-PAGE-008: Direct Page Access via URL
- [ ] **Tested**

**Deskripsi:** Akses page langsung via URL

**Steps to Test:**
1. Manually type URL: `/items?page=3`
2. Load page

**Expected Result:**
- Page 3 langsung ditampilkan
- Data correct untuk page 3
- Pagination state correct

---

### TC-PAGE-009: Invalid Page Number
- [ ] **Tested**

**Deskripsi:** Handle invalid page number di URL

**Steps to Test:**
1. Akses: `/items?page=999` (page yang tidak ada)
2. Akses: `/items?page=-1` (negative page)
3. Akses: `/items?page=abc` (non-numeric)

**Expected Result:**
- Redirect ke page 1 atau show empty result
- No crash atau error 500
- Graceful handling

---

### TC-PAGE-010: Pagination dengan Search/Filter
- [ ] **Tested**

**Deskripsi:** Pagination bekerja dengan search dan filter

**Steps to Test:**
1. Search "Laptop" (hasil >10 items)
2. Periksa pagination muncul
3. Navigate ke page 2

**Expected Result:**
- Pagination untuk search results
- Filter tetap aktif saat pindah page
- URL: `/items?search=Laptop&page=2`

---

## 10. Testing Authentication

### TC-AUTH-001: Login dengan Kredensial Valid
- [ ] **Tested**

**Deskripsi:** Login dengan username dan password benar

**Steps to Test:**
1. Akses halaman login
2. Isi username dan password yang valid
3. Submit

**Expected Result:**
- Redirect ke dashboard atau home page
- Session created
- User logged in
- Flash message: "Login berhasil"

---

### TC-AUTH-002: Login dengan Password Salah
- [ ] **Tested**

**Deskripsi:** Login dengan password incorrect

**Steps to Test:**
1. Isi username benar
2. Isi password salah
3. Submit

**Expected Result:**
- Error message: "Username atau password salah"
- User tetap di halaman login
- Tidak redirect
- No session created

---

### TC-AUTH-003: Login dengan Username Tidak Ada
- [ ] **Tested**

**Deskripsi:** Login dengan username yang tidak terdaftar

**Steps to Test:**
1. Isi username yang tidak ada di database
2. Isi password
3. Submit

**Expected Result:**
- Error message: "Username atau password salah"
- (Jangan spesifik "username tidak ada" untuk security)

---

### TC-AUTH-004: Login dengan Field Kosong
- [ ] **Tested**

**Deskripsi:** Validasi required fields di login

**Steps to Test:**
1. Submit login form tanpa isi username dan password
2. Test juga dengan hanya salah satu field kosong

**Expected Result:**
- Error: "Username dan password harus diisi"
- Form tidak submit

---

### TC-AUTH-005: Logout
- [ ] **Tested**

**Deskripsi:** User dapat logout

**Steps to Test:**
1. Login terlebih dahulu
2. Klik tombol "Logout"

**Expected Result:**
- User ter-logout
- Session destroyed
- Redirect ke login page
- Flash message: "Logout berhasil"

---

### TC-AUTH-006: Protected Routes (Unauthorized Access)
- [ ] **Tested**

**Deskripsi:** User tidak bisa akses halaman tanpa login

**Steps to Test:**
1. Logout atau buka browser incognito
2. Coba akses URL protected: `/items`, `/categories`, `/dashboard`

**Expected Result:**
- Redirect ke login page
- Flash message: "Silakan login terlebih dahulu"
- Routes ter-protect dengan middleware auth

---

### TC-AUTH-007: Session Persistence
- [ ] **Tested**

**Deskripsi:** Session persist setelah reload

**Steps to Test:**
1. Login
2. Refresh page atau close-reopen tab
3. Periksa masih logged in

**Expected Result:**
- User masih logged in
- Session tetap valid
- Tidak perlu login ulang

---

### TC-AUTH-008: Session Timeout (Opsional)
- [ ] **Tested**

**Deskripsi:** Session expire setelah idle

**Steps to Test:**
1. Login
2. Idle (tidak ada aktivitas) sesuai timeout duration
3. Coba akses halaman

**Expected Result:**
- Session expired
- Redirect ke login
- Message: "Session anda telah berakhir"
- (Skip jika tidak ada session timeout)

---

### TC-AUTH-009: Remember Me (Jika Ada Fitur)
- [ ] **Tested**

**Deskripsi:** Remember me checkbox functionality

**Steps to Test:**
1. Login dengan centang "Remember Me"
2. Close browser completely
3. Buka browser lagi dan akses aplikasi

**Expected Result:**
- User masih logged in (via cookie)
- Tidak perlu login ulang
- (Skip jika fitur tidak ada)

---

### TC-AUTH-010: Redirect After Login
- [ ] **Tested**

**Deskripsi:** Redirect ke halaman yang diminta setelah login

**Steps to Test:**
1. Logout
2. Coba akses `/items` (protected route)
3. Redirect ke login
4. Login dengan valid credentials

**Expected Result:**
- Setelah login, redirect ke `/items` (halaman yang diminta)
- Bukan ke dashboard/home
- (Opsional feature - check if implemented)

---

## Testing Summary

**Total Test Cases:** 86

**Breakdown:**
- CRUD Kategori: 10 test cases
- CRUD Barang: 10 test cases
- Search dan Filter: 8 test cases
- Dashboard: 8 test cases
- Validasi Form: 10 test cases
- Error Handling: 8 test cases
- Flash Messages: 7 test cases
- Responsive Design: 5 test cases
- Pagination: 10 test cases
- Authentication: 10 test cases

---

## Testing Notes

### Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)

### Device Testing
- [ ] Desktop (1920x1080)
- [ ] Laptop (1366x768)
- [ ] Tablet (iPad 768x1024)
- [ ] Mobile (iPhone SE 375x667)
- [ ] Large Mobile (iPhone 14 Pro 430x932)

### Performance Notes
- [ ] Dashboard loads < 3 seconds with 100+ items
- [ ] Search results return < 1 second
- [ ] Page navigation smooth and fast

### Security Notes
- [ ] SQL Injection tests passed
- [ ] CSRF protection active (if implemented)
- [ ] Authentication working properly
- [ ] No sensitive data exposure in errors

---

**Deployment Verification:** ✅ Complete (2026-06-25)
**Manual Testing Started:** __________  
**Manual Testing Completed:** __________  
**Tested By:** __________  
**Overall Status:** 
- 🟢 Deployment & Infrastructure: Complete
- 🔴 Manual Functional Testing: Not Started (86 test cases pending)

---

## Next Steps

1. **Setup Testing Environment**
   ```bash
   php artisan serve
   # Access: http://localhost:8000
   ```

2. **Create Test Data** (if needed)
   - Add sample categories (5-10 items)
   - Add sample items (20-30 items with various stock levels)
   - Ensure some items have low stock (< 10)

3. **Start Testing**
   - Follow checklist from top to bottom
   - Mark checkbox `[x]` when test completed
   - Document bugs in separate file

4. **Bug Reporting Format**
   ```markdown
   ### Bug-XXX: [Title]
   - Severity: Critical/High/Medium/Low
   - Module: [Category/Item/Dashboard/etc]
   - Steps to Reproduce: 
   - Expected: 
   - Actual: 
   - Screenshot: (if applicable)
   ```

**Good luck with testing!** 🚀
