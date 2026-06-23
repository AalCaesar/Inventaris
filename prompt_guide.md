# PROMPT GUIDE UNTUK AI

> Panduan Prompt Siap Pakai untuk AI Coding Assistant
> 
> **Versi:** 1.0  
> **Tanggal:** 23 Juni 2026  
> **Proyek:** Sistem Inventaris Laravel

---

## 📖 TENTANG DOKUMEN INI

Dokumen ini berisi prompt yang siap digunakan untuk AI coding assistant (seperti Kilo, Claude, Cursor, GitHub Copilot, dll) dalam mengerjakan proyek Sistem Inventaris Laravel.

Setiap prompt dirancang untuk:
- Mengerjakan task spesifik dari tugas_anggota.md
- Memberikan context yang cukup untuk AI
- Menghasilkan kode yang sesuai dengan desain.md dan workflow.md
- Mengikuti best practices Laravel

---

## 🎯 CARA MENGGUNAKAN PROMPT INI

### Langkah Umum:
1. Baca tugas_anggota.md untuk tahu task mana yang akan dikerjakan
2. Pastikan dependency task sudah selesai
3. Buka file/folder yang relevan di editor
4. Copy prompt yang sesuai dari dokumen ini
5. Paste ke AI coding assistant
6. Review hasil kode dari AI
7. Test secara manual
8. Mark task sebagai done di tugas_anggota.md

### Tips Menggunakan AI:
- **Be Specific**: Semakin spesifik prompt, semakin baik hasilnya
- **Provide Context**: Beri tahu AI file mana yang sudah ada dan strukturnya
- **Iterative**: Jika hasil kurang sesuai, minta AI untuk revisi dengan feedback spesifik
- **Review Code**: Selalu review kode yang dihasilkan AI, jangan langsung commit
- **Test**: Test semua fitur yang dibuat AI secara manual

---

## 🚀 FASE 0: SETUP & PREPARATION

### Task 0.1: Environment Setup

**Prompt untuk AI:**
```
Saya sedang setup proyek Laravel Inventaris. Tolong bantu saya:

1. Verify bahwa semua dependencies sudah terinstall dengan benar
2. Check file .env apakah sudah dikonfigurasi dengan benar untuk database MySQL
3. Jalankan migration untuk setup database
4. Verify bahwa development server bisa berjalan

Berikan saya langkah-langkah command yang harus saya jalankan di terminal.
```

**Context:**
- Tidak perlu file khusus, ini adalah setup awal
- Pastikan sudah di direktori D:\ASN_LARAVEL\Inventaris

---

### Task 0.2: Familiarisasi dengan Desain

**Prompt untuk AI:**
```
Saya baru bergabung di proyek Laravel Inventaris. Di proyek ini ada 3 file dokumentasi:
- desain.md (spesifikasi sistem)
- workflow.md (proses development)
- tugas_anggota.md (pembagian tugas)

Tolong baca ketiga file ini dan buatkan saya summary singkat tentang:
1. Fitur apa saja yang akan dibuat
2. Struktur database (tabel dan relasi)
3. Teknologi stack yang digunakan
4. Timeline development

Format dalam bullet points yang mudah dibaca.
```

**Context:**
- Baca desain.md, workflow.md, tugas_anggota.md
- Ini untuk onboarding anggota tim baru

---

## 🔧 FASE 1: FOUNDATION & MODELS

### Task 1.1: Setup Authentication

**Prompt untuk AI:**
```
Tolong install dan setup Laravel Breeze untuk authentication di proyek Laravel 11 ini.

Requirements:
- Gunakan Breeze dengan Blade stack (bukan React/Vue)
- Setelah install, customize tampilan login page dengan branding "Sistem Inventaris"
- Setup middleware auth untuk protect routes yang memerlukan authentication
- Test bahwa register, login, dan logout berfungsi dengan benar

Berikan saya:
1. Command-command yang harus dijalankan
2. File mana saja yang perlu dimodifikasi untuk branding
3. Cara setup middleware auth di routes

Jika ada file yang perlu diedit, tunjukkan kode lengkapnya.
```

**Context:**
- Fresh Laravel 11 installation
- Belum ada authentication system

**Expected Output:**
- Installation commands
- Modified auth views dengan branding
- Middleware setup di routes/web.php

---

### Task 1.2: Lengkapi Model Category

**Prompt untuk AI:**
```
Saya punya model Category di app/Models/Category.php yang masih kosong (hanya ada skeleton class).

Tolong lengkapi model ini dengan:
1. Property $fillable untuk mass assignment (field: name)
2. Relationship hasMany ke model Item
3. (Optional) Method atau scope yang berguna untuk kategori

Sesuaikan dengan struktur database:
- Table: categories
- Columns: id, name, created_at, updated_at
- Relasi: One Category has Many Items

Berikan kode lengkap untuk file app/Models/Category.php
```

**Context:**
- File app/Models/Category.php sudah ada tapi masih kosong
- Migration categories sudah ada dan sudah di-run

**Expected Output:**
- Complete Category model dengan fillable dan relationships

---

### Task 1.3: Lengkapi Model Item

**Prompt untuk AI:**
```
Saya punya model Item di app/Models/Item.php yang masih kosong.

Tolong lengkapi model ini dengan:
1. Property $fillable untuk mass assignment (fields: category_id, item_code, name, stock, price)
2. Relationship belongsTo ke model Category
3. Accessor untuk format harga dalam Rupiah (getPriceFormattedAttribute)
4. Scope untuk query barang dengan stok rendah (scopeLowStock, threshold default 10)
5. (Optional) Cast untuk tipe data yang tepat

Sesuaikan dengan struktur database:
- Table: items
- Columns: id, category_id, item_code, name, stock, price, created_at, updated_at
- Relasi: Item belongs to Category

Berikan kode lengkap untuk file app/Models/Item.php
```

**Context:**
- File app/Models/Item.php sudah ada tapi masih kosong
- Migration items sudah ada dan sudah di-run

**Expected Output:**
- Complete Item model dengan fillable, relationships, accessor, dan scope

---

## 📦 FASE 2: BACKEND - KATEGORI MODULE

### Task 2.1: CategoryController - CRUD

**Prompt untuk AI:**
```
Tolong buatkan CategoryController dengan resource controller pattern untuk CRUD kategori.

Requirements:
1. Generate controller dengan: php artisan make:controller CategoryController --resource
2. Implement semua method CRUD:
   - index(): List semua kategori dengan pagination (10 per page), include count jumlah items
   - create(): Return view form tambah kategori
   - store(): Validasi dan simpan kategori baru, redirect dengan flash message
   - edit($id): Return view form edit kategori
   - update($id): Validasi dan update kategori, redirect dengan flash message
   - destroy($id): Hapus kategori (check dulu apakah ada items terkait, jika ada tolak dengan message)

Validasi untuk kategori:
- name: required, string, max 255 karakter

Flash messages:
- Success: "Kategori berhasil ditambahkan/diupdate/dihapus"
- Error: "Kategori tidak bisa dihapus karena masih ada barang terkait"

Gunakan Eloquent untuk semua database operations.
Berikan kode lengkap untuk app/Http/Controllers/CategoryController.php
```

**Context:**
- Model Category sudah lengkap dengan relationships
- Views belum dibuat (akan dibuat di task berikutnya)

**Expected Output:**
- Complete CategoryController dengan semua CRUD methods

---

### Task 2.2: Routes untuk Kategori

**Prompt untuk AI:**
```
Tolong tambahkan routes untuk CategoryController di routes/web.php.

Requirements:
1. Gunakan resource route untuk CategoryController
2. Semua routes kategori harus protected dengan middleware auth
3. Route names otomatis mengikuti convention (categories.index, categories.create, dll)

Berikan kode yang harus ditambahkan ke routes/web.php.
Tunjukkan juga daftar lengkap routes yang akan ter-generate beserta HTTP method dan URL-nya.
```

**Context:**
- CategoryController sudah dibuat
- File routes/web.php sudah ada dengan auth routes dari Breeze

**Expected Output:**
- Route definition untuk categories resource
- List semua routes yang ter-generate

---

### Task 2.3: Views untuk Kategori

**Prompt untuk AI:**
```
Tolong buatkan semua Blade views untuk CRUD kategori.

Requirements:

1. Layout Master (resources/views/layouts/app.blade.php):
   - Gunakan Bootstrap 5
   - Include sidebar navigation (menu: Dashboard, Kategori, Barang)
   - Include top navbar dengan user info dan logout button
   - Include breadcrumb section
   - Include section untuk flash messages (success/error)
   - Responsive design

2. Index View (resources/views/categories/index.blade.php):
   - Tombol "Tambah Kategori" di kanan atas (link ke create)
   - Search box (belum functional, nanti fase enhancement)
   - Tabel kategori dengan kolom: No, Nama Kategori, Jumlah Barang, Aksi
   - Pagination links
   - Tombol Edit (btn-warning) dan Hapus (btn-danger) di kolom Aksi
   - Konfirmasi hapus dengan SweetAlert2

3. Create View (resources/views/categories/create.blade.php):
   - Form dengan CSRF token
   - Input nama kategori (required)
   - Tombol Simpan (btn-success) dan Batal (btn-secondary)
   - Tampilkan validation errors jika ada

4. Edit View (resources/views/categories/edit.blade.php):
   - Sama seperti create tapi form method PUT
   - Input terisi dengan data kategori existing

Gunakan Bootstrap 5 untuk styling.
Include CDN SweetAlert2 di layout untuk konfirmasi delete.

Berikan kode lengkap untuk semua 4 files view.
```

**Context:**
- CategoryController sudah ada dan functional
- Routes sudah ada
- Belum ada views sama sekali

**Expected Output:**
- 4 blade files: layouts/app.blade.php, categories/index.blade.php, categories/create.blade.php, categories/edit.blade.php
- Fully styled dengan Bootstrap 5
- SweetAlert2 untuk delete confirmation

---

## 📦 FASE 3: BACKEND - BARANG MODULE

### Task 3.1: ItemController - CRUD

**Prompt untuk AI:**
```
Tolong buatkan ItemController dengan resource controller pattern untuk CRUD barang.

Requirements:
1. Generate controller dengan: php artisan make:controller ItemController --resource
2. Implement semua method CRUD:
   - index(): List barang dengan eager loading kategori, pagination 15 per page, support search (item_code/name) dan filter by category_id
   - create(): Return view form tambah, pass list categories untuk dropdown
   - store(): Validasi dan simpan barang baru dengan semua fields, redirect dengan flash message
   - show($id): Return view detail barang dengan info lengkap
   - edit($id): Return view form edit, pass item data dan list categories
   - update($id): Validasi dan update barang, redirect dengan flash message
   - destroy($id): Hapus barang, redirect dengan flash message

Validasi untuk barang:
- category_id: required, exists di table categories
- item_code: required, string, max 50, unique (kecuali saat edit item sendiri)
- name: required, string, max 255
- stock: required, integer, min 0
- price: required, integer, min 0

Search dan Filter:
- Jika ada query parameter 'search', cari di item_code atau name (LIKE)
- Jika ada query parameter 'category_id', filter by category

Flash messages yang sesuai untuk setiap operasi.
Gunakan Eloquent untuk semua operations.

Berikan kode lengkap untuk app/Http/Controllers/ItemController.php
```

**Context:**
- Model Item sudah lengkap dengan relationships
- Model Category sudah ada
- Views belum dibuat

**Expected Output:**
- Complete ItemController dengan CRUD, search, filter functionality

---

### Task 3.2: Routes untuk Barang

**Prompt untuk AI:**
```
Tolong tambahkan routes untuk ItemController di routes/web.php.

Requirements:
1. Gunakan resource route untuk ItemController
2. Semua routes items harus protected dengan middleware auth
3. Route names otomatis (items.index, items.create, items.show, dll)

Berikan kode yang harus ditambahkan ke routes/web.php.
Tunjukkan juga daftar lengkap routes yang ter-generate.
```

**Context:**
- ItemController sudah dibuat
- CategoryController routes sudah ada

**Expected Output:**
- Route definition untuk items resource

---

### Task 3.3: Views untuk Barang

**Prompt untuk AI:**
```
Tolong buatkan semua Blade views untuk CRUD barang (items).

Requirements:

1. Index View (resources/views/items/index.blade.php):
   - Extend layout master yang sudah ada
   - Tombol "Tambah Barang" di kanan atas
   - Section untuk search dan filter:
     * Input search (item_code atau name)
     * Dropdown filter kategori (ambil dari database)
     * Tombol Search dan Reset
   - Tabel barang dengan kolom: No, Kode Barang, Nama, Kategori, Stok, Harga, Aksi
   - Format harga: Rp 100.000 (gunakan number_format PHP)
   - Badge warning untuk stok rendah (jika stok < 10)
   - Pagination links
   - Tombol View Detail, Edit, Hapus di kolom Aksi
   - Konfirmasi hapus dengan SweetAlert2

2. Create View (resources/views/items/create.blade.php):
   - Form dengan CSRF token
   - Input kode barang (text, required, unique)
   - Input nama barang (text, required)
   - Select kategori (dropdown dari database, required)
   - Input stok (number, required, min 0, default 0)
   - Input harga (number, required, min 0)
   - Tombol Simpan dan Batal
   - Tampilkan validation errors

3. Edit View (resources/views/items/edit.blade.php):
   - Sama seperti create dengan form method PUT
   - Semua input terisi dengan data barang existing
   - Kode barang readonly (tidak bisa diubah)

4. Show View (resources/views/items/show.blade.php):
   - Display semua detail barang dalam format card yang rapi
   - Info: Kode, Nama, Kategori, Stok, Harga
   - Badge untuk status stok (success jika cukup, warning jika rendah)
   - Tombol Edit dan Kembali ke List

Gunakan Bootstrap 5 untuk styling yang konsisten dengan views kategori.

Berikan kode lengkap untuk semua 4 files view.
```

**Context:**
- ItemController sudah ada dan functional
- Routes sudah ada
- Layout master sudah ada dari Task 2.3

**Expected Output:**
- 4 blade files: items/index.blade.php, items/create.blade.php, items/edit.blade.php, items/show.blade.php
- Fully styled dan responsive
- Search dan filter functionality di index

---

## 📊 FASE 4: DASHBOARD

### Task 4.1: DashboardController

**Prompt untuk AI:**
```
Tolong buatkan DashboardController untuk menampilkan statistik dan ringkasan inventaris.

Requirements:
1. Generate controller: php artisan make:controller DashboardController
2. Implement method index() yang mengambil data:
   - Total kategori (count dari table categories)
   - Total barang (count dari table items)
   - Total nilai inventaris (SUM dari stock * price semua items)
   - List barang stok rendah (items dengan stock < 10, include kategori, limit 10 items)
   - Data untuk chart: jumlah items per kategori (untuk Chart.js)

3. Pass semua data ke view dashboard
4. Optimize queries (gunakan aggregate functions, eager loading untuk relasi)

Berikan kode lengkap untuk app/Http/Controllers/DashboardController.php
```

**Context:**
- Models Category dan Item sudah lengkap dengan relationships
- Views belum ada

**Expected Output:**
- Complete DashboardController dengan statistik dan data untuk dashboard

---

### Task 4.2: Dashboard View

**Prompt untuk AI:**
```
Tolong buatkan view dashboard yang menarik dan informatif.

Requirements:

1. Layout (resources/views/dashboard.blade.php):
   - Extend layout master
   - Breadcrumb: Home / Dashboard

2. Statistics Cards (4 cards dalam 1 row, responsif):
   - Card 1: Total Kategori (icon, angka besar, warna primary)
   - Card 2: Total Barang (icon, angka besar, warna success)
   - Card 3: Total Nilai Inventaris (format Rupiah, warna info)
   - Card 4: Barang Stok Rendah (count, warna warning)

3. Section Barang Stok Rendah:
   - Card dengan header "Barang Perlu Restock"
   - Tabel dengan kolom: Kode, Nama, Kategori, Stok
   - Badge warning untuk stok
   - Link "Lihat Semua" ke halaman items dengan filter stok rendah

4. Section Chart:
   - Card dengan header "Distribusi Barang per Kategori"
   - Canvas untuk Chart.js (bar chart atau pie chart)
   - Data dari controller (categories dan count items)

5. Integrate Chart.js:
   - Include Chart.js via CDN
   - Create chart dengan data dari controller
   - Responsive chart

Gunakan Bootstrap 5, Font Awesome untuk icons.
Design harus clean, modern, dan mudah dibaca.

Berikan kode lengkap untuk resources/views/dashboard.blade.php termasuk script Chart.js.
```

**Context:**
- DashboardController sudah ada dengan data statistik
- Layout master sudah ada
- Chart.js belum di-include

**Expected Output:**
- Complete dashboard view dengan cards, tabel, dan chart
- Responsive design
- Chart.js integrated

---

### Task 4.3: Route Dashboard

**Prompt untuk AI:**
```
Tolong tambahkan route untuk dashboard di routes/web.php.

Requirements:
1. Route untuk DashboardController index method
2. URL: /dashboard
3. Route name: dashboard
4. Middleware: auth
5. Set dashboard sebagai redirect destination setelah login (modify RedirectIfAuthenticated middleware atau auth config)

Berikan:
1. Kode route yang harus ditambahkan
2. Kode untuk set dashboard sebagai home setelah login

Jika ada file lain yang perlu dimodifikasi, tunjukkan juga.
```

**Context:**
- DashboardController dan view sudah ada
- Auth routes dari Breeze sudah ada

**Expected Output:**
- Route definition untuk dashboard
- Configuration untuk redirect after login

---

## 🧪 FASE 5: TESTING & POLISHING

### Task 5.1: Manual Testing

**Prompt untuk AI:**
```
Tolong buatkan checklist testing komprehensif untuk aplikasi Inventaris ini dalam format markdown yang bisa saya gunakan untuk manual testing.

Checklist harus cover:
1. Testing CRUD Kategori (semua operasi: create, read, update, delete)
2. Testing CRUD Barang (semua operasi termasuk validasi unique item_code)
3. Testing Search dan Filter di halaman Items
4. Testing Dashboard (verifikasi statistik akurat)
5. Testing Validasi Form (required fields, format, unique constraints)
6. Testing Error Handling (404, validation errors, delete kategori dengan items)
7. Testing Flash Messages (success dan error messages)
8. Testing Responsive Design (mobile, tablet, desktop)
9. Testing Pagination
10. Testing Authentication (login, logout, protected routes)

Format setiap test case dengan:
- Test Case ID
- Deskripsi
- Steps to test
- Expected result
- Checkbox untuk mark as tested

Berikan checklist lengkap yang bisa saya print atau copy ke dokumen terpisah.
```

**Context:**
- Semua fitur development sudah selesai
- Siap untuk comprehensive testing

**Expected Output:**
- Detailed testing checklist dalam format markdown
- Organized by module/feature

---

### Task 5.2: Bug Fixing

**Prompt untuk AI:**
```
Saya menemukan beberapa bugs saat testing aplikasi Inventaris:

[List bugs yang ditemukan, contoh:]
1. Pagination tidak berfungsi saat menggunakan search
2. Flash message tidak hilang setelah refresh
3. Validation error untuk unique item_code tidak akurat saat edit

Tolong bantu saya fix bugs ini satu per satu. 
Untuk setiap bug:
- Analisa root cause
- Berikan solusi dengan kode lengkap
- Explain kenapa bug terjadi dan bagaimana fix-nya mencegah masalah serupa

[Sesuaikan dengan bugs yang benar-benar ditemukan saat testing]
```

**Context:**
- Testing sudah dilakukan (Task 5.1)
- Bugs sudah di-identify dan di-list

**Expected Output:**
- Root cause analysis untuk setiap bug
- Complete fix dengan code changes
- Prevention strategies

---

### Task 5.3: Code Cleanup & Optimization

**Prompt untuk AI:**
```
Tolong review dan optimize kode aplikasi Inventaris ini untuk production readiness.

Tasks:
1. Scan dan remove semua debugging code:
   - dd(), dump(), var_dump() di PHP
   - console.log() di JavaScript
   - Commented out code yang tidak terpakai

2. Check dan fix N+1 query problems:
   - Review semua queries di Controllers
   - Tambahkan eager loading jika perlu
   - Optimize database queries

3. Code formatting consistency:
   - Ensure PSR-12 compliance
   - Consistent indentation dan spacing
   - Remove unused imports

4. Security check:
   - Verify CSRF tokens di semua forms
   - Check output escaping di Blade (gunakan {{ }} bukan {!! !!})
   - Verify authorization checks

Berikan laporan:
1. File-file mana yang perlu di-cleanup
2. Kode yang perlu diubah/dihapus
3. Optimizations yang di-apply
4. Security issues yang ditemukan (jika ada)
```

**Context:**
- Semua fitur sudah selesai dan tested
- Siap untuk production preparation

**Expected Output:**
- Cleanup report dengan daftar perubahan
- Optimized code
- Security audit results

---

### Task 5.4: Documentation

**Prompt untuk AI:**
```
Tolong bantu saya lengkapi dokumentasi aplikasi Inventaris untuk production.

Tasks:
1. Update README.md dengan:
   - Deskripsi aplikasi
   - Features list
   - Requirements (PHP, MySQL, dll)
   - Installation steps (step-by-step)
   - Configuration (.env setup)
   - How to run (development & production)
   - Screenshots (placeholder untuk saya isi nanti)
   - Troubleshooting common issues
   - License dan credits

2. Update .env.example dengan:
   - Semua environment variables yang diperlukan
   - Comments untuk setiap config

3. (Optional) Create CHANGELOG.md:
   - Version 1.0.0 features
   - Release notes

Berikan kode lengkap untuk README.md dan .env.example yang professional dan comprehensive.
```

**Context:**
- Aplikasi sudah production-ready
- Perlu dokumentasi untuk deployment dan maintenance

**Expected Output:**
- Complete README.md
- Updated .env.example
- Optional CHANGELOG.md

---

## 🚀 FASE 6: DEPLOYMENT

### Task 6.1: Pre-deployment Preparation

**Prompt untuk AI:**
```
Tolong buatkan deployment checklist dan script preparation untuk deploy aplikasi Inventaris ke production server.

Requirements:
1. Pre-deployment checklist:
   - Environment setup (.env for production)
   - Security settings (APP_DEBUG=false, APP_ENV=production)
   - Database backup procedures
   - File permissions setup

2. Deployment script atau step-by-step commands untuk:
   - Install dependencies (composer install --optimize-autoloader --no-dev)
   - Build assets (npm run build)
   - Run migrations
   - Cache optimization (config:cache, route:cache, view:cache)
   - Set proper file permissions (storage, bootstrap/cache)

3. Post-deployment verification checklist:
   - Test critical features
   - Check error logs
   - Verify database connection
   - Test authentication

Berikan lengkap dengan commands dan explanations.
```

**Context:**
- Development selesai
- Siap deploy ke production

**Expected Output:**
- Complete deployment checklist
- Step-by-step deployment commands
- Post-deployment verification steps

---

### Task 6.2: Production Deployment

**Prompt untuk AI:**
```
Saya akan deploy aplikasi Inventaris ke [shared hosting / VPS / cloud platform].

Tolong berikan panduan deployment spesifik untuk platform ini:
1. Server requirements dan setup
2. Web server configuration (Apache .htaccess atau Nginx config)
3. SSL certificate setup (Let's Encrypt)
4. Domain/subdomain configuration
5. Database setup di production
6. File upload dan permissions
7. Cron jobs setup (jika diperlukan)
8. Monitoring dan logging setup

Sertakan:
- Configuration files lengkap
- Commands untuk execution
- Common issues dan troubleshooting
- Maintenance tips

[Sesuaikan platform dengan kebutuhan: shared hosting, VPS, cloud, dll]
```

**Context:**
- Pre-deployment prep sudah selesai
- Siap untuk actual deployment

**Expected Output:**
- Platform-specific deployment guide
- Configuration files
- Troubleshooting guide

---

## 🎓 TIPS MENGGUNAKAN AI SECARA EFEKTIF

### 1. Be Specific and Contextual
- Sertakan informasi tentang file yang sudah ada
- Jelaskan struktur project
- Berikan contoh jika memungkinkan

### 2. Iterative Approach
- Jika hasil tidak sesuai, minta revisi dengan feedback spesifik
- Contoh: "Kode bagus, tapi tolong tambahkan error handling untuk case X"

### 3. Review dan Test
- Selalu review kode yang dihasilkan AI
- Test secara manual sebelum commit
- Pahami kode yang digenerate, jangan hanya copy-paste

### 4. Provide Feedback
- Jika AI generate kode yang error, kasih tahu error-nya
- AI bisa belajar dari feedback dan improve

### 5. Use for Learning
- Minta AI untuk explain kode yang digenerate
- Tanya "why" di balik design decisions
- Gunakan sebagai learning tool, bukan hanya code generator

---

## 📊 TRACKING PROGRESS

Saat menggunakan prompt guide ini:
1. ✅ Buka tugas_anggota.md untuk lihat task breakdown
2. ✅ Copy prompt yang sesuai dari dokumen ini
3. ✅ Paste ke AI dan tunggu hasil
4. ✅ Review dan test hasil dari AI
5. ✅ Mark task sebagai done di tugas_anggota.md dengan checkbox [x]
6. ✅ Commit changes dengan message yang jelas
7. ✅ Move ke task berikutnya

---

## 🎯 KESIMPULAN

Dokumen ini menyediakan prompt siap pakai untuk semua 26+ tasks dalam proyek Sistem Inventaris Laravel.

**Workflow yang Recommended:**
1. Kerjakan tasks sesuai urutan fase (0 → 1 → 2 → 3 → 4 → 5 → 6)
2. Pastikan dependency tasks sudah selesai sebelum mulai task baru
3. Test setiap fitur setelah selesai di-implement
4. Komunikasi dengan tim untuk koordinasi
5. Update progress di tugas_anggota.md secara berkala

**Estimasi Total Waktu:** 2-3 minggu untuk MVP (sesuai skill level dan availability tim)

**Good luck dengan development! 🚀**

---

**Dokumen ini adalah companion untuk tugas_anggota.md. Update jika ada perubahan workflow atau requirements.**
