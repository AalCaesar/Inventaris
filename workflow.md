# WORKFLOW DEVELOPMENT

> Panduan Proses Development untuk Proyek Sistem Inventaris
> 
> **Versi:** 1.0  
> **Tanggal:** 23 Juni 2026  
> **Tim:** Development Team

---

## 🌿 GIT WORKFLOW & BRANCHING STRATEGY

### Branch Structure

```
main (production-ready)
  ├── develop (development branch)
  │    ├── feature/kategori-crud
  │    ├── feature/barang-crud
  │    ├── feature/dashboard
  │    └── feature/laporan
  └── hotfix/critical-bug
```

### Branch Naming Convention

- **main**: Branch utama untuk production
- **develop**: Branch utama untuk development
- **feature/[nama-fitur]**: Untuk fitur baru (contoh: `feature/kategori-crud`)
- **bugfix/[nama-bug]**: Untuk bug fix (contoh: `bugfix/validasi-stok`)
- **hotfix/[nama-hotfix]**: Untuk urgent fix di production

### Git Workflow Steps

**1. Setup Awal (Satu kali)**
```bash
git clone [repository-url]
cd Inventaris
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

**2. Mulai Fitur Baru**
```bash
git checkout develop
git pull origin develop
git checkout -b feature/nama-fitur
```

**3. Development Process**
```bash
# Coding...
git add .
git commit -m "feat: deskripsi singkat fitur"
git push origin feature/nama-fitur
```

**4. Merge ke Develop**
```bash
# Setelah fitur selesai dan tested
git checkout develop
git pull origin develop
git merge feature/nama-fitur
git push origin develop
```

**5. Deploy ke Production**
```bash
# Setelah develop stable dan tested
git checkout main
git merge develop
git tag -a v1.0.0 -m "Release version 1.0.0"
git push origin main --tags
```

### Commit Message Convention

Gunakan format semantic commit:

```
<type>(<scope>): <subject>

<body (optional)>
```

**Types:**
- `feat`: Fitur baru
- `fix`: Bug fix
- `docs`: Dokumentasi
- `style`: Formatting, tidak mengubah kode
- `refactor`: Refactoring kode
- `test`: Menambah atau update test
- `chore`: Maintenance task

**Contoh:**
```bash
git commit -m "feat(kategori): tambah CRUD kategori"
git commit -m "fix(barang): validasi kode barang duplikat"
git commit -m "docs: update README dengan setup instructions"
```

---

## 💻 DEVELOPMENT ENVIRONMENT SETUP

### Requirements

- **PHP**: 8.2 atau lebih tinggi
- **Composer**: 2.6+
- **Node.js**: 18.x atau lebih tinggi
- **NPM**: 9.x+
- **MySQL**: 8.0+
- **Git**: Latest version

### Setup Project (Lengkap)

**1. Clone & Install Dependencies**
```bash
git clone [repository-url]
cd Inventaris
composer install
npm install
```

**2. Environment Configuration**
```bash
cp .env.example .env
```

Edit file `.env`:
```env
APP_NAME="Sistem Inventaris"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventaris
DB_USERNAME=root
DB_PASSWORD=
```

**3. Generate Key & Setup Database**
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed  # Jika ada seeder
```

**4. Build Assets**
```bash
npm run dev  # Untuk development
# atau
npm run build  # Untuk production
```

**5. Run Development Server**
```bash
php artisan serve
# Akses: http://localhost:8000
```

### Database Setup

**Membuat Database MySQL:**
```sql
CREATE DATABASE inventaris CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Run Migrations:**
```bash
php artisan migrate
```

**Reset Database (jika perlu):**
```bash
php artisan migrate:fresh
php artisan migrate:fresh --seed  # dengan seeder
```

---

## 📝 CODING STANDARDS

### PHP Coding Standards (PSR-12)

**1. Indentation**: 4 spaces (bukan tabs)
**2. Line Length**: Max 120 karakter per baris
**3. Naming Conventions**:
   - Classes: `PascalCase` (contoh: `ItemController`)
   - Methods: `camelCase` (contoh: `getItemsByCategory`)
   - Variables: `camelCase` (contoh: `$itemCode`)
   - Constants: `UPPER_SNAKE_CASE` (contoh: `MAX_ITEMS`)

**4. File Structure**:
```php
<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // Method implementation
    }
}
```

### Laravel Best Practices

**1. Controllers**
- Gunakan Resource Controllers untuk CRUD
- Thin controllers, fat models
- Satu controller untuk satu resource

**2. Models**
- Definisikan `$fillable` atau `$guarded`
- Definisikan relationships dengan jelas
- Gunakan accessors/mutators jika perlu

**3. Routes**
```php
// Gunakan resource routes untuk CRUD
Route::resource('categories', CategoryController::class);
Route::resource('items', ItemController::class);

// Atau explicit routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
```

**4. Blade Templates**
- Gunakan components untuk reusable parts
- Escape output dengan `{{ }}` (otomatis)
- Gunakan `@csrf` di semua form

**5. Validation**
```php
// Di Controller atau Form Request
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'item_code' => 'required|unique:items,item_code',
    'stock' => 'required|integer|min:0',
]);
```

### JavaScript Coding Standards

**1. Gunakan ES6+ syntax**
**2. Prefer `const` dan `let`, hindari `var`**
**3. Use arrow functions untuk callbacks**

```javascript
// Good
const handleDelete = (id) => {
    if (confirm('Hapus data ini?')) {
        deleteItem(id);
    }
};

// Avoid
var handleDelete = function(id) {
    // ...
};
```

### CSS Conventions

**1. Gunakan BEM naming (optional)**
```css
.card {}
.card__header {}
.card__body {}
.card--primary {}
```

**2. Prefer utility classes dari Bootstrap/Tailwind**

---

## 🧪 TESTING APPROACH

### Manual Testing Checklist

Setiap fitur harus ditest secara manual sebelum merge:

**✅ Kategori Module**
- [ ] List kategori tampil dengan benar
- [ ] Tambah kategori berhasil dan tampil di list
- [ ] Edit kategori update data dengan benar
- [ ] Hapus kategori (tanpa barang terkait) berhasil
- [ ] Hapus kategori (dengan barang terkait) ditolak dengan message
- [ ] Search kategori berfungsi
- [ ] Pagination berfungsi

**✅ Barang Module**
- [ ] List barang tampil dengan info lengkap
- [ ] Tambah barang dengan validasi berfungsi
- [ ] Kode barang unique ter-validasi
- [ ] Edit barang update data dengan benar
- [ ] Hapus barang berhasil
- [ ] Search barang berfungsi
- [ ] Filter by kategori berfungsi
- [ ] Detail barang tampil lengkap

**✅ Dashboard**
- [ ] Statistik akurat (total kategori, barang, nilai)
- [ ] Barang stok rendah tampil dengan benar
- [ ] Chart kategori render dengan benar

**✅ Validasi & Error Handling**
- [ ] Required fields ter-validasi
- [ ] Format input ter-validasi
- [ ] Error messages jelas dan helpful
- [ ] Success messages tampil setelah aksi

### Automated Testing (Optional - Phase 2)

**Setup PHPUnit:**
```bash
php artisan test
```

**Contoh Test:**
```php
public function test_can_create_category()
{
    $response = $this->post('/categories', [
        'name' => 'Elektronik'
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('categories', ['name' => 'Elektronik']);
}
```

---

## 🚀 DEPLOYMENT PROCESS

### Development Environment

```bash
# Pull latest changes
git pull origin develop

# Update dependencies
composer install
npm install

# Run migrations
php artisan migrate

# Build assets
npm run dev

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Production Deployment

**1. Pre-deployment Checklist**
- [ ] Semua test passed
- [ ] Code reviewed
- [ ] Database backup created
- [ ] `.env` configured untuk production
- [ ] `APP_DEBUG=false` di production

**2. Deployment Steps**
```bash
# Pull latest from main
git pull origin main

# Update dependencies (production only)
composer install --optimize-autoloader --no-dev

# Run migrations
php artisan migrate --force

# Build assets
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache
```

**3. Post-deployment**
- [ ] Test critical features
- [ ] Monitor error logs
- [ ] Check application performance

---

## 🛠️ COMMON COMMANDS

### Laravel Artisan Commands

```bash
# Generate Model, Migration, Controller, Seeder
php artisan make:model Item -mcrs

# Run migrations
php artisan migrate
php artisan migrate:rollback
php artisan migrate:fresh

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate app key
php artisan key:generate

# Tinker (Laravel REPL)
php artisan tinker
```

### NPM Commands

```bash
# Development (with hot reload)
npm run dev

# Production build
npm run build

# Watch for changes
npm run watch
```

### Database Commands

```bash
# Export database
mysqldump -u root -p inventaris > backup.sql

# Import database
mysql -u root -p inventaris < backup.sql
```

---

## 📊 CODE REVIEW CHECKLIST

Sebelum merge, pastikan:

- [ ] Kode mengikuti PSR-12 standards
- [ ] Tidak ada hardcoded values (gunakan config/env)
- [ ] Validasi input lengkap
- [ ] Error handling proper
- [ ] Tidak ada console.log atau dd() yang tertinggal
- [ ] Database queries optimal (N+1 query check)
- [ ] Security best practices (CSRF, XSS prevention)
- [ ] Responsive design tested
- [ ] Browser compatibility checked

---

## 🐛 DEBUGGING TIPS

### Laravel Debugging

**1. Debug Bar (Install)**
```bash
composer require barryvdh/laravel-debugbar --dev
```

**2. Log Files**
```bash
# Check logs
tail -f storage/logs/laravel.log
```

**3. Tinker untuk Test Query**
```bash
php artisan tinker
>>> App\Models\Item::all()
>>> App\Models\Category::find(1)->items
```

### Common Issues

**Issue: 500 Error**
- Check `storage/logs/laravel.log`
- Ensure `.env` configured correctly
- Check file permissions

**Issue: CSS/JS not loading**
```bash
npm run build
php artisan config:clear
```

**Issue: Migration errors**
```bash
php artisan migrate:fresh  # WARNING: drops all tables
```

---

## 📞 TEAM COMMUNICATION

### Daily Standup (Optional)
- Update progress harian
- Share blockers
- Koordinasi task yang overlap

### Code Review Process
- Buat Pull Request di GitHub/GitLab
- Tag reviewer
- Address feedback
- Merge setelah approval

### Documentation
- Update dokumen ini jika ada perubahan workflow
- Comment kode yang kompleks
- Update README untuk setup instructions baru

---

**Workflow ini adalah guideline. Adjust sesuai kebutuhan tim dan project scale.**
